<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Models;
use Illuminate\Support\Facades\File;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('models')->with('brands')->get();
        
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = ['DRAFT','ACTIVE','INACTIVE'];
        $brands = Brand::get(['id','name']);
        $models = Models::get(['id','name']);
        return view('admin.cars.create', compact('statuses','brands','models') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand' => 'required|numeric',
            'model' => 'required|numeric',
            'price' => 'required|numeric',
            'penumpang' => 'required|numeric',
            'description' => 'required',
            'image' => ['required','image','mimes:jpeg,png,jpg,gif','max:4096'],
            'status' =>  ['required']
        ]);

        if($data->validated()) {
            // not store to folder
            $image = $request->file('image')->store(
                'cars/images', 'public'
            );
            
            Car::create($request->except('image','_token') + ['image'=>$image, 'created_by'=> \Auth::user()->id]);
        }

        return redirect()->route('admin.cars.index')->with([
            'message' => 'berhasil dibuat',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $statuses = ['DRAFT','ACTIVE','INACTIVE'];
        $brands = Brand::get(['id','name']);
        $models = Models::get(['id','name']);
        return view('admin.cars.edit', compact('statuses','brands','models','car') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $data = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand' => 'required|numeric',
            'model' => 'required|numeric',
            'price' => 'required|numeric',
            'penumpang' => 'required|numeric',
            'description' => 'required',
            'image' => ['required','image','mimes:jpeg,png,jpg,gif','max:4096'],
            'status' =>  ['required']
        ]);

        if($data->validated()) {
            // not store to folder
            if($request->image){
                File::delete('storage/', $car->image );
                $image = $request->file('image')->store(
                    'cars/images', 'public'
                );
                $car->update($request->except('image','_token') + ['image' => $image, 'updated_by'=> \Auth::user()->id]);
            } else {
                $car->update($request->all() + ['updated_by'=> \Auth::user()->id]);
            }
            
        }

        return redirect()->route('admin.cars.index')->with([
            'message' => 'berhasil di edit',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        File::delete('storage/' . $car->image);
        $car->delete();

        return redirect()->back()->with([
            'message' => 'berhasil di hapus',
            'alert-type' => 'danger'
        ]);
    }
}
