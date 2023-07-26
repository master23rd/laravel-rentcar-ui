<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rents = Rent::with('user')->with('cars.brands','cars.models')->withTrashed()->get();
        return view('admin.rental.index', compact('rents'));
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $statuses = ['BOOKED','PAID','ONDUTY','FINISH','CANCEL'];
        $rent = Rent::where('id', $id)->with('cars')->withTrashed()->first();
        return view('admin.rental.edit', compact('rent','statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rent $rent)
    {
        $data = \Validator::make($request->all(),[
            'status' => 'required',
        ])->validate();
        $rent = Rent::where('id', $request->id)->with('cars')->withTrashed()->first();
       
        if($rent->status === 'CANCEL' && $request->status!=='CANCEL'){
            $rent->status = $request->status;
            $rent->restore();     
        }

        $rent->update();
        
        return redirect()->back()->with([
            'message' => 'Data Berhasil diedit',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        //
    }
}
