<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = ['name' , 'numberPlate' , 'seat' , 'image' , 'buses_id'];

    public function Buses(){
        return $this->belongsTo(Buses::class, 'buses_id');
    }
}
