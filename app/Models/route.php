<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class route extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $fillable = [
        'location_id','start_point','end_point','travel_time'
    ];
}
