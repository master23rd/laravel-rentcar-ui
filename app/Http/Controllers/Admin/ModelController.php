<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Models;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Models::get();
        return view('admin.model.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.model.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ])->validate();

        $model = new Models;
        $model->name = $request->name;
        $model->created_by = \Auth::user()->id;
        $model->save();

        return redirect()->route('admin.models.index')->with([
            'message' => 'berhasil dibuat',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Models $model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Models $model)
    {
        return view('admin.model.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Models $model)
    {
        $data = \Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        $brand->update($data->validate());

        return redirect()->route('admin.models.index')->with([
            'message' => 'berhasil di buat',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models $model)
    {
        $model->delete();
        return redirect()->back()->with([
            'message' => 'berhasil di hapus',
            'alert-type' => 'danger'
        ]);
    }
}
