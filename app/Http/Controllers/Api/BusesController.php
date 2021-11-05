<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buses;
use App\Models\Service_car;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BusesResource;

class BusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_sv = Buses::with('Service')->get();
        // echo"<pre>";
        // print_r($list_sv);die;
        // echo"</pre>";
        return $list_sv;
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
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|unique:buses|max:255',
        //     'image' => 'required:buses|max:255',
        //     'seat' => 'required|integer|:buses|max:255',
        //     'price' => 'required|integer|not_in:0:buses',
        //     'startPointName' => 'required:buses|max:255',
        //     'startPointId' => 'required|integer:buses|max:255',
        //     'endPointName' => 'required:buses|max:255',
        //     'endPointId' => 'required|integer:buses|max:255',
        //     'date_active' => 'required:buses|max:255',
        //     'start_time' => 'required:buses|max:255',
        //     'description' => 'required:buses|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ]);
        // } else{
            $model = new Buses();
            $model->fill($request->all());
            $model->save();
            if ($request->service_id){
                $request->service_id=array_unique($request->service_id);
                foreach ($request->service_id as $sv =>$v) {
                $data = [
                    'buses_id' => $model->id,
                    'service_id'=>$request->service_id[$sv],
                    ];
                    Service_car::create($data);
                }
            }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $buses = Buses::with('Service')->where('id', '=', $id)->first();
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

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required:buses|max:255',
        //     'image' => 'required:buses|max:255',
        //     'seat' => 'required|integer|:buses|max:255',
        //     'price' => 'required|integer|not_in:0:buses',
        //     'startPointName' => 'required:buses|max:255',
        //     'startPointId' => 'required|integer:buses|max:255',
        //     'endPointName' => 'required:buses|max:255',
        //     'endPointId' => 'required|integer:buses|max:255',
        //     'date_active' => 'required:buses|max:255',
        //     'start_time' => 'required:buses|max:255',
        //     'description' => 'required:buses|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ]);
        // } else{
            $buses = Buses::findOrFail($id);
            $buses->update($request->all());
            if ($request->service_id){
                $request->service_id=array_unique($request->service_id);
                Service_car::where('buses_id', $id)->delete();
                foreach ($request->service_id as $sv =>$v) {
                $data = [
                    'buses_id' => $id,
                    'service_id'=>$request->service_id[$sv],
                    ];
                    Service_car::create($data);
                }
            }

        // }
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
        $buses->Service()->detach();
        $buses->delete();
    }

    public function search(Request $request)
    {
        $search_query = Buses::with(['Service']);
        if ($request->startPointId) {
            $search_query->where('startPointId', $request->startPointId);
        }
        if ($request->endPointId) {
            $search_query->where('endPointId', $request->endPointId);
        }
        if ($request->date_active) {
            $search_query->where('date_active', $request->date_active);
        }
        $bus = $search_query->get();
        return $bus;
    }

}
