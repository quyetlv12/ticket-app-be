<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;
use App\Models\Permission;
use App\Models\Buses;
use App\Models\Service;
use App\Models\Ticket;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->UserAndRole();
        $this->permission();
        $this->rolePermission();
        $this->roleNhanVien();

    }

    public function UserAndRole(){
        $userAdmin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => '2021-12-07T16:21:42.000000Z',
                'phone_number' => '0384056544',
                'password' => bcrypt('123456'),
                "image" => 'img.jpg',
                "gender" => 'nam',
                'created_at' => now(),
                'updated_at' => now()
        ]);
        $userStaff = User::create([
                'name' => 'Nhân viên phụ trách',
                'email' => 'staff@gmail.com',
                'email_verified_at' => '2021-12-07T16:21:42.000000Z',
                'phone_number' => '01692582890',
                'password' => bcrypt('123456'),
                "image" => 'img.jpg',
                "gender" => 'nam',
                'created_at' => now(),
                'updated_at' => now()
        ]);

        $roleADmin = Roles::create([

                'name'        => 'admin',
                'display_name'=>'Quản trị viên'

        ]);
        $roleStaff = Roles::create([

                'name'        => 'Nhân viên',
                'display_name'=>'Nhân viên'


        ]);




        $roleOfUserAdmin =  DB::table('user_roles')->insert([
            'role_id' => $roleADmin->id,
            'user_id' => $userAdmin->id,
        ]);


        $roleOfUserStaff =  DB::table('user_roles')->insert([
            'role_id' => $roleStaff->id,
            'user_id' => $userStaff->id,
        ]);


    }


 ///////////////////////////////////////////////// ---- DATA PERMISSION ------//////////////////////////
 public function permission(){


            // quản lý tài khoản cha
                $userPermission_Parent= Permission::create([
                    'name'        => 'Tài khoản',
                    'display_name'=> 'Quản lý tài khoản',
                    'parent_id'   => 0,
                    'key_code'    => 'user'
            ]);
            // quản lý tài khoản con
            $userPermission= DB::table('permissions')->insert([
                [
                    'name'        => 'Danh sách tài khoản',
                    'display_name'=> 'Danh sách tài khoản',
                    'parent_id'   => $userPermission_Parent->id,
                    'key_code'    => 'list_user'
                ],
                [
                    'name'        => 'Thêm tài khoản',
                    'display_name'=> 'Thêm tài khoản',
                    'parent_id'   => $userPermission_Parent->id,
                    'key_code'    => 'add_user'
                ],
                [
                    'name'        => 'Cập nhật tài khoản',
                    'display_name'=> 'Cập nhật tài khoản',
                    'parent_id'   => $userPermission_Parent->id,
                    'key_code'    => 'edit_user'

                ],
                [
                    'name'        => 'Xoá tài khoản',
                    'display_name'=> 'Xoá tài khoản',
                    'parent_id'   => $userPermission_Parent->id,
                    'key_code'    => 'delete_user'

                ]
            ]);

            // quản lý role cha
            $rolePermission_Parent= Permission::create([
                'name'        => 'Vai trò',
                'display_name'=> 'Quản lý vai trò',
                'parent_id'   => 0,
                'key_code'    => 'role'

                ]);
                // quản lý role con
                $rolePermission= DB::table('permissions')->insert([
                    [
                        'name'        => 'Danh sách Vai trò',
                        'display_name'=> 'Danh sách Vai trò',
                        'parent_id'   => $rolePermission_Parent->id,
                        'key_code'    => 'list_role'

                    ],
                    [
                        'name'        => 'Thêm Vai trò',
                        'display_name'=> 'Thêm Vai trò',
                        'parent_id'   => $rolePermission_Parent->id,
                        'key_code'    => 'add_role'

                    ],
                    [
                        'name'        => 'Cập nhật Vai trò',
                        'display_name'=> 'Cập nhật Vai trò',
                        'parent_id'   => $rolePermission_Parent->id,
                        'key_code'    => 'edit_role'

                    ],
                    [
                        'name'        => 'Xoá Vai trò',
                        'display_name'=> 'Xoá Vai trò',
                        'parent_id'   => $rolePermission_Parent->id,
                        'key_code'    => 'delete_role'

                    ]
                ]);



        // quản lý chuyến xe cha
            $busesPermission_Parent= Permission::create([
                'name'        => 'Chuyến xe',
                'display_name'=> 'Quản lý chuyến xe',
                'parent_id'   => 0,
                'key_code'    => 'buses'

                ]);
        // quản lý chuyến xe con
                $busesPermission= DB::table('permissions')->insert([
                    [
                        'name'        => 'Danh sách chuyến xe',
                        'display_name'=> 'Danh sách chuyến xe',
                        'parent_id'   => $busesPermission_Parent->id,
                        'key_code'    => 'list_buses'

                    ],
                    [
                        'name'        => 'Thêm chuyến xe',
                        'display_name'=> 'Thêm chuyến xe',
                        'parent_id'   => $busesPermission_Parent->id,
                        'key_code'    => 'add_buses'

                    ],
                    [
                        'name'        => 'Cập nhật chuyến xe',
                        'display_name'=> 'Cập nhật chuyến xe',
                        'parent_id'   => $busesPermission_Parent->id,
                        'key_code'    => 'edit_buses'

                    ],
                    [
                        'name'        => 'Xoá chuyến xe',
                        'display_name'=> 'Xoá chuyến xe',
                        'parent_id'   => $busesPermission_Parent->id,
                        'key_code'    => 'delete_buses'

                    ]
                ]);

                // quản lý dịch vụ cha
            $servicePermission_Parent= Permission::create([
                'name'        => 'Dịch vụ',
                'display_name'=> 'Quản lý dịch vụ',
                'parent_id'   => 0,
                'key_code'    => 'service'

                ]);
        // quản lý dịch vụ con
                $servicePermission= DB::table('permissions')->insert([
                    [
                        'name'        => 'Danh sách dịch vụ',
                        'display_name'=> 'Danh sách dịch vụ',
                        'parent_id'   => $servicePermission_Parent->id,
                        'key_code'    => 'list_service'

                    ],
                    [
                        'name'        => 'Thêm dịch vụ',
                        'display_name'=> 'Thêm dịch vụ',
                        'parent_id'   => $servicePermission_Parent->id,
                        'key_code'    => 'add_service'

                    ],
                    [
                        'name'        => 'Cập nhật dịch vụ',
                        'display_name'=> 'Cập nhật dịch vụ',
                        'parent_id'   => $servicePermission_Parent->id,
                        'key_code'    => 'edit_service'

                    ],
                    [
                        'name'        => 'Xoá dịch vụ',
                        'display_name'=> 'Xoá dịch vụ',
                        'parent_id'   => $servicePermission_Parent->id,
                        'key_code'    => 'delete_service'

                    ]
                ]);


        //           // quản lý vé cha
        //     $ticketPermission_Parent= Permission::create([
        //         'name'        => 'Vé xe',
        //         'display_name'=> 'Quản lý vé xe',
        //         'parent_id'   => 0,
        //         'key_code'    => 'ticket'

        //         ]);
        // // quản lý vé con
        //         $ticketPermission= DB::table('permissions')->insert([
        //             [
        //                 'name'        => 'Danh sách vé xe',
        //                 'display_name'=> 'Danh sách vé xe',
        //                 'parent_id'   => $ticketPermission_Parent->id,
        //                 'key_code'    => 'list_ticket'

        //             ],
        //             [
        //                 'name'        => 'Thêm vé xe',
        //                 'display_name'=> 'Thêm vé xe',
        //                 'parent_id'   => $ticketPermission_Parent->id,
        //                 'key_code'    => 'add_ticket'

        //             ],
        //             [
        //                 'name'        => 'Cập nhật vé xe',
        //                 'display_name'=> 'Cập nhật vé xe',
        //                 'parent_id'   => $ticketPermission_Parent->id,
        //                 'key_code'    => 'edit_ticket'

        //             ],
        //             [
        //                 'name'        => 'Xoá vé xe',
        //                 'display_name'=> 'Xoá vé xe',
        //                 'parent_id'   => $ticketPermission_Parent->id,
        //                 'key_code'    => 'delete_ticket'

        //             ]
        //         ]);


        // quản lý loại xe cha
            $cartypePermission_Parent= Permission::create([
                'name'        => 'Loại xe',
                'display_name'=> 'Quản lý loại xe',
                'parent_id'   => 0,
                'key_code'    => 'cartype'

                ]);
        // quản lý loại xe con
                $cartypePermission= DB::table('permissions')->insert([
                    [
                        'name'        => 'Danh sách loại xe',
                        'display_name'=> 'Danh sách loại xe',
                        'parent_id'   => $cartypePermission_Parent->id,
                        'key_code'    => 'list_cartype'

                    ],
                    [
                        'name'        => 'Thêm loại xe',
                        'display_name'=> 'Thêm loại xe',
                        'parent_id'   => $cartypePermission_Parent->id,
                        'key_code'    => 'add_cartype'

                    ],
                    [
                        'name'        => 'Cập nhật loại xe',
                        'display_name'=> 'Cập nhật loại xe',
                        'parent_id'   => $cartypePermission_Parent->id,
                        'key_code'    => 'edit_cartype'

                    ],
                    [
                        'name'        => 'Xoá loại xe',
                        'display_name'=> 'Xoá loại xe',
                        'parent_id'   => $cartypePermission_Parent->id,
                        'key_code'    => 'delete_cartype'

                    ]
                ]);

                 // quản lý NEWS cha
            $newsPermission_Parent= Permission::create([
                'name'        => 'Bài viết',
                'display_name'=> 'Quản lý bài viết',
                'parent_id'   => 0,
                'key_code'    => 'news'

                ]);
        // quản lý NEWS con
                $newsPermission= DB::table('permissions')->insert([
                    [
                        'name'        => 'Danh sách bài viết',
                        'display_name'=> 'Danh sách bài viết',
                        'parent_id'   => $newsPermission_Parent->id,
                        'key_code'    => 'list_news'

                    ],
                    [
                        'name'        => 'Thêm bài viết',
                        'display_name'=> 'Thêm bài viết',
                        'parent_id'   => $newsPermission_Parent->id,
                        'key_code'    => 'add_news'

                    ],
                    [
                        'name'        => 'Cập nhật bài viết',
                        'display_name'=> 'Cập nhật bài viết',
                        'parent_id'   => $newsPermission_Parent->id,
                        'key_code'    => 'edit_news'

                    ],
                    [
                        'name'        => 'Xoá bài viết',
                        'display_name'=> 'Xoá bài viết',
                        'parent_id'   => $newsPermission_Parent->id,
                        'key_code'    => 'delete_news'

                    ]
                ]);
            }
////////////////////////////// -------------Tài khoản Admin full quyền -------------//////////////


              public function rolePermission(){
                $permiss  = Permission::all('id');
                $role = Roles::where('name','admin')->first();
                foreach($permiss as $permiss){
                    DB::table('role_permissions')->insert([
                        'role_id' => $role->id,
                        'permission_id' => $permiss->id,
                    ]);
                }
              }

              public function roleNhanVien(){

                  //lấy id của thằng cha
                $permissID  = Permission::where('key_code','user')->first();
                // lấy tất cả id thằng con theo parent_id = id thằng cha
                $parent_id = Permission::where('parent_id',$permissID->id)->get('id');
                //lấy tất cả id tk con

                   //lấy tất cả theo id ngoại trừ  $permisionChidren

                   $permiss  = Permission::whereNotIn('id',$parent_id)->get();

                   $role = Roles::where('name','Nhân viên')->first();
                foreach($permiss as $permiss){
                    DB::table('role_permissions')->insert([
                        'role_id' => $role->id,
                        'permission_id' => $permiss->id,
                    ]);
                }

              }

        }


