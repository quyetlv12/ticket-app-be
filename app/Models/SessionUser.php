<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    protected $guarded = [];
    public function getId()
    {
    return $this->user_id;
    }
    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function checkPermissionAccess($permissionCheck){

        $role = User::find(auth()->user()->getId())->roles;//lấy tất cả role của user

            foreach($role as $role)
            {
                $permissions = $role->permission; // lấy các quyền thêm sửa xoá của role trong permission với key_code
                if($permissions->contains('key_code',$permissionCheck)){
                    return true;
                }
            }
            return false;
    }
}
