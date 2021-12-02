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
        'startWard_id',
        'startWard_name',
        'startDisrict_id',
        'startDistrict_name',
        'endWard_id',
        'endWard_name',
        'endDisrict_id',
        'endDistrict_name',
        'detailAddressStart',
        'detailAddressEnd',
        'seat_empty',
        'date_active',
        'start_time',
        'range_time',
        'end_time',
        'status',
        'description'
    ];
    public function Service(){
        return $this->belongsToMany(Service::class, 'service_cars','buses_id', 'service_id');
    }
    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
