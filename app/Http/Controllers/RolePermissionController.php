<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use DB;

class RolePermissionController extends Controller
{
    private $role;
    public function __construct(Roles $role, Permission $permissions){
        $this->role = $role;
        $this->permissions = $permissions;
        if($this->middleware('auth:api_sessionuser') == false){
            return response()->json([
                'message' => 'Token không hợp lệ bạn cần đăng nhập lại'
            ],401);
        }
    }
    public function index(){
        if (! Gate::allows('list_role')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
        $role = $this->role::with('permission')->get();
        return $role;
        }
    }

    public function store(Request $request){

        if (! Gate::allows('add_role')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
            $role = $this->role->create([
                'name'=> $request->name,
                'display_name'=>$request->display_name
            ]);
            $role->permission()->attach($request->permission_id);//nhận vào mảng
           //sync delete tất cả cái cũ thêm cái mới vào user_role
           $userAddnew = $this->role::with('permission')->where('id',$role->id)->get();
           return response()->json([
            $userAddnew,
            'status'=>'Tạo mới thành công'
            ],200);
        }
    }

    public function show($id)
    {
        $role = $this->role::with('permission')->where('id',$id)->get();
        return $role;
    }
    public function update(Request $request, $id)
    {
        if (! Gate::allows('update_role')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
            $this->role->find($id)->update([
            'name'=> $request->name,
            'display_name'=>$request->display_name
        ]);
        $role =$this->role->find($id);
        //thêm role vào bảng role


        $role->permission()->sync($request->permission_id);
        $roleUpdatenew = $this->role::with('permission')->where('id',$role->id)->get();
        return response()->json([
            $roleUpdatenew,
            'status'=>'Cập nhật thành công'
        ],200);
    }
    }

    public function destroy($id)
    {
        if (! Gate::allows('delete_role')) {
            return response()->json([
                'message' => 'bạn không có quyền truy cập'
            ],403);
        }else{
        $this->role->find($id)->delete();
        return response()->json([
            'code' => 200,
            'message'=>'success'
        ],200);
        }
    }
}
