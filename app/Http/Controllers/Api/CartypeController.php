<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cartype;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CartypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth:api_sessionuser',['except' => ['index']]);
   }
    public function index()
    {
        $cartype = Cartype::all();
        return $cartype;
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
        //     'name' => 'required|unique:car_types|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ]);
        // } else{

            if (! Gate::allows('add_cartype')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
                $createcar_type = Cartype::create($request->all());
                return response()
                ->json(['message' => 'Thêm loại xe thành công']);

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
        $cartype = Cartype::find($id);
        return $cartype;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cartype = Cartype::find($id);
        return $cartype;
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
        //     'name' => 'required|unique:car_types|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ]);
        // } else{

            if (! Gate::allows('edit_cartype')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
            $cartype = Cartype::findOrFail($id);
            $cartype->update($request->all());
            return response()
            ->json(['message' => 'Cập nhật chuyến xe thành công']);

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
        if (! Gate::allows('delete_cartype')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
        $cartype = Cartype::findOrFail($id);
        $cartype->delete();
        return response()
            ->json(['message' => 'Xóa loại xe thành công']);
        }
    }
}
