<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buses extends Model
{
    use HasFactory;
    protected $table = "buses";
    protected $fillable =
    [
        'name',
        'cartype_id',
        'image',
        'seat',
        'price',
        'startPointName',
        'startPointId',
        'endPointName',
        'endPointId',
        'date_active',
        'start_time',
        'status',
        'description'
    ];
    public function Service(){
        return $this->belongsToMany(Service::class, 'service_cars','buses_id', 'service_id')->withPivot('service_price');
    }
}
