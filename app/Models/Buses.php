<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buses extends Model
{
    use HasFactory;
    protected $table = "buses";
    protected $fillable = [
        'name','cartype_id','route_id','image', 'seat','price','date_active','start_time','status','description'
    ];
}
