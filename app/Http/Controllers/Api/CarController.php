<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Buses;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     */
    public function __construct()
    {

        $this->middleware('auth:api_sessionuser', ['except' => ['index', 'store', 'update']]);
    }
    public function index(Request $request)
    {
        $filterFieldValue = $request->query('empty_buses_id');
        if($filterFieldValue){
            return Car::whereNull('buses_id')->get();
        }else{
            $cars = Car::with('Buses')->get();
            return response()->json($cars);
        }
        // if (!Gate::allows('list_car')) {
        //     return response()->json([
        //         'message' => 'bạn không có quyền truy cập'
        //     ],403);
        // }else{
        //     $cars = Car::get();
        //     return response()->json($cars);
        // }

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // if (!Gate::allows('add_car')) {
        //     return response()->json([
        //         'message' => 'bạn không có quyền truy cập'
        //     ],403);
        // }else{
        //     $model = new Car();
        //     $model->fill($request->all());
        //     $model->save();
        //     return response()
        //     ->json(['message' => 'Thêm xe thành công !', 200]);
        // }


        $model = new Car();
        $model->fill($request->all());
        $model->save();
        return response()
        ->json(['message' => 'Thêm xe thành công !', 200]);
     
        // update car id for buses table 
        // if ($request->buses_id) {
        //     # code..
        //     $buses = Buses::find($request->buses_id);
        //     // check car id === null 
        //     if ($buses->car_id == '' || $buses->car_id == null) {
        //         # code...
        //         $buses->car_id = $request->buses_id;
        //         $buses->save();
              
        //         // response
        //         return response()
        //             ->json(['message' => 'Thêm xe thành công !', 200]);
        //     } else {
        //         return response()
        //             ->json('Chuyến xe đã tồn tại' , 400);
        //     }
        // } else {
        //     $model->save();
        //     // response
        //     return response()
        //         ->json(['message' => 'Thêm xe thành công !', 200]);
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
        //
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
        //
        $buses = Car::findOrFail($id);
        $buses->update($request->all());
        return response()
            ->json(['message' => 'Cập nhật xe thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
