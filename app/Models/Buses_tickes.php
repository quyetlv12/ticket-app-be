<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buses_tickes extends Model
{
    use HasFactory;
    protected $table = "buses_tickes";
    public $fillable = [
        'buses_id', 'ticket_id'
    ];
    public function buses(){
        return $this->belongsTo(Buses::class,'buses_id');
    }
    public function ticket(){
        return $this->belongsTo(Service::class,'ticket_id');
    }
}
