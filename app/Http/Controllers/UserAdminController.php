<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\HTTP\Requests\AddUserAdmin as AddUserAdminRequest;
use DB;

class UserAdminController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        private $user;
        private $role;

        public function __construct(User $user, Roles $role){
            $this->user = $user;
            $this->role = $role;
            $this->middleware('auth:api_sessionuser');


        }
        public function index()
        {
            if (! Gate::allows('list_user')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{

                $users = $this->user::with('roles')->get();
                return $users;
            }
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
            if (! Gate::allows('add_user')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{

            $email = User::where('email', '=', $request->email)->first() ;
            $phone_number = User::where('phone_number', '=', $request->phone_number)->first();
            if( ! $email AND ! $phone_number){
                $user = $this->user->create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone_number" => $request->phone_number,
                    "password" => bcrypt($request->password),
                    "image" => $request->image,
                    "gender" => $request->gender,
                ]);

                //thêm role vào bảng role
                $roleId = $request->role_id;
                $user->roles()->attach($roleId);
                $usercreatenew = $this->user::with('roles')->where('id',$user->id)->get();//lấy tài khoản vừa tạo
                return response()->json($usercreatenew,200);
            }elseif(!$phone_number){
                return response()
                ->json(['error' => 'Error: Email đã được sử dụng']);
            }else {
                return response()
                ->json(['error' => 'Error: SĐT đã được sử dụng']);
            }
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
            $user = $this->user::with('roles')->where('id',$id)->get();
            return $user;
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {

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
            if (! Gate::allows('update_user')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
                $newPassword = $request->get('password');
                if(empty($newPassword)){
                    $this->user->find($id)->update($request->except('password'));
            }else{
            $this->user->find($id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone_number" => $request->phone_number,
                "password" => bcrypt($request->password),
                "image" => $request->image,
                "gender" => $request->gender,
            ]);
            }
            $user =$this->user->find($id);
            //thêm role vào bảng role
            $roleId = $request->role_id;
            $user->roles()->sync($roleId);
            $userUpdatenew = $this->user::with('roles')->where('id',$user->id)->get();
            return response()->json([
                $userUpdatenew,
                'status'=>'Cập nhật thành công'
            ],200);
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
            if (! Gate::allows('delete_user')) {
                return response()->json([
                    'message' => 'bạn không có quyền truy cập'
                ],403);
            }else{
            $this->user->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message'=>'success'
            ],200);
        }
    }
}
