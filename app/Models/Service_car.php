<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_car extends Model
{
    use HasFactory;
    protected $table = "service_cars";
    public $fillable = [
        'buses_id', 'service_id'
    ];
    public function buses(){
        return $this->belongsTo(Buses::class,'buses_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
