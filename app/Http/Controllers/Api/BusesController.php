<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buses;
use App\Models\Service_car;
use Illuminate\Support\Facades\Validator;

class BusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Buses::all();
        return response()->json([
            'Success' => true,
            'product' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:buses|max:255',
            'cartype_id' => 'required|integer:buses|max:255',
            'image' => 'required:buses|max:255',
            'seat' => 'required|integer|:buses|max:255',
            'price' => 'required|integer|not_in:0:buses',
            'startPointName' => 'required:buses|max:255',
            'startPointId' => 'required|integer:buses|max:255',
            'endPointName' => 'required:buses|max:255',
            'endPointId' => 'required|integer:buses|max:255',
            'date_active' => 'required:buses|max:255',
            'start_time' => 'required:buses|max:255',
            'status' => 'required:buses',
            'description' => 'required:buses|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        } else{
            return $createbuses = Buses::create($request->all());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buses = Buses::find($id);
        return $buses;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buses = Buses::find($id);
        return $buses;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:buses|max:255',
            'cartype_id' => 'required|integer:buses|max:255',
            'image' => 'required:buses|max:255',
            'seat' => 'required|integer|:buses|max:255',
            'price' => 'required|integer|not_in:0:buses',
            'startPointName' => 'required:buses|max:255',
            'startPointId' => 'required|integer:buses|max:255',
            'endPointName' => 'required:buses|max:255',
            'endPointId' => 'required|integer:buses|max:255',
            'date_active' => 'required:buses|max:255',
            'start_time' => 'required:buses|max:255',
            'status' => 'required:buses',
            'description' => 'required:buses|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        } else{
            $buses = Buses::findOrFail($id);
            $buses->update($request->all());
            return $buses;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buses = Buses::findOrFail($id);
        $buses->delete();
    }



}
