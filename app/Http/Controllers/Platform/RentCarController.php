<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\RentCar;
use App\Models\Car;
use Illuminate\Support\Facades\File;

class RentCarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::where('status',1);
        
        if($request->model_id && $request->passengers){
            $cars = $cars
                ->where("passengers", $request->passengers)
                ->WhereHas('models',function($q) use ($request) {
                    $q->where('id', $request->model_id);
                })
                ->with('brands')
                ->get();
            
        } else {
            $cars = Car::with('models')->with('brands')->get();
        }

        
        return view('platform.cars.index', compact('cars'));
    }

    public function show($id)
    {
        $car = Car::where('id', $id)->with('models')->with('brands')->first();
        return view('platform.cars.detail', compact('car'));
    }

    public function listRent()
    {
        $rents = Rent::with('cars.brands','cars.models')->withTrashed()->get();
       
        return view('platform.rental.index', compact('rents'));
    }  
    
    public function detailRent($id)
    {
        $rent = Rent::where('id', $id)->with('cars')->first();
        
        return view('platform.rental.detail', compact('rent'));
    }  

    public function checkAvailability(Request $request, Rent $rent)
    {
        \Validator::make($request->all(), [
            'car_id' => 'required',
            'booked_start' => 'required',
            'booked_end' => 'required',
            // 'user_id' => 'required',
        ])->validate();

        
        $data = Rent::where('status','!=','cancel')->whereHas("cars", function($q) use ($request){
            $q->where('car_id', $request->car_id)
            ->where('booked_start', '>=', $request->booked_start)
            ->where('booked_end', '<=', $request->booked_end);
        })->get();
       
        if($data->count()){
            $message = 'mobil tidak tersedia';
            $alert = 'failed';

            return redirect()->back()->with([
                'message' => $message,
                'alert-type' => $alert,
            ]);
        }

        return redirect()->route('rent.process',['carId'=>$request->car_id, 'booked_start'=>$request->booked_start, 'booked_end'=>$request->booked_end]);
        
    }

    public function process(Request $request)
    {
        //count duration
        $start = new \DateTime($request->booked_start);
        $finish = new \DateTime($request->booked_end);
        $int = $start->diff($finish);
        $dur = $int->days;

        $car = Car::where('id', $request->carId)->with('models')->with('brands')->first();
        $car->start = $request->booked_start;
        $car->end = $request->booked_end;
        $car->duration = $dur;
        $car->totalPrice = $car->price * $dur;

        return view('platform.rental.process', compact('car'));
    }

    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'car_id' => 'required',
            'booked_start' => 'required',
            'booked_end' => 'required',
            'duration' => 'required',
            // 'user_id' => 'required',
        ])->validate();

        $rent = new Rent;
        $rent->user_id = \Auth::user()->id;
        $rent->duration = $request->duration;
        $rent->invoice_number = date('YmdHis');
        $rent->status = 'BOOKED';

        if($rent->save()){
            //[multiple rent todo]
            $car = Car::where('id', $request->car_id)->first('price');
            $rentCar = new RentCar;
            $rentCar->car_id = $request->car_id;
            $rentCar->rent_id = $rent->id;
            $rentCar->total_price = (int)$car->price * $request->duration;
            $rentCar->booked_start = $request->booked_start;
            $rentCar->booked_end = $request->booked_end;
            $rentCar->save();
        }
        
        return redirect()->route('rent.detail',['id' => $rent->id])->with([
            'message' => 'berhasil di buat',
            'alert-type' => 'success'
        ]);
    }

    public function update(Request $request, Rent $rent)
    {
        $data = \Validator::make($request->all(), [
            'image' => ['required','image','mimes:jpeg,png,jpg,gif','max:4096'],
        ]);

        if($data->validated()) {
            $rent->status = 'PAID';
            // not store to folder
            if($request->image){
                File::delete('storage/', $rent->image );
                $image = $request->file('image')->store(
                    'cars/images', 'public'
                );
                $rent->image = $image;
                $rent->update();
            } else {
                $rent->update($request->all() + ['status' => 'PAID']);
            }
            
        }

        return redirect()->route('rent.detail',['id' => $rent->id])->with([
            'message' => 'Pembayaran Berhasil',
            'alert-type' => 'success'
        ]);
    }

    public function cancel(Request $request, Rent $rent)
    {
        File::delete('storage/' . $rent->image);
        $rent->status = 'CANCEL';
        $rent->update();
        $rent->delete();

        return redirect()->route('rent.list')->with([
            'message' => 'berhasil di cancel',
            'alert-type' => 'danger'
        ]);
    }

    

}
