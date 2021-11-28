<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
class ServiceController extends Controller
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
        $service = Service::all();
        return $service;
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
        //     'name' => 'required|unique:services|max:10|min:5',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ]);
        // } else{
            if (! Gate::allows('add_service')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
            $createservice = Service::create($request->all());
            return response()
            ->json(['message' => 'Thêm dịch vụ thành công']);
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
        $service = Service::find($id);
        return $service;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return $service;
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
        //     'name' => 'required|unique:services|max:10|min:5',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator->errors()
        //     ]);
        // } else{
            if (! Gate::allows('edit_service')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
            $service = Service::findOrFail($id);
            $service->update($request->all());
            return response()
            ->json(['message' => 'Cập nhật dịch vụ thành công']);

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
        if (! Gate::allows('delete_service')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
        $service = Service::findOrFail($id);
        $service->delete();
        return response()
            ->json(['message' => 'Xóa dịch vụ thành công']);
        }
    }
}
