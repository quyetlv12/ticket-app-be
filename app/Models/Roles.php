<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function permission(){
        return  $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id');
     }
}
