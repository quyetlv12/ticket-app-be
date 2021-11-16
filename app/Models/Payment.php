<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
    protected $fillable =
    [
        'ticket_id',
        'ticket_code',
        'price',
        'note',
        'vnp_response_code',
        'code_vnpay',
        'code_bank',
        'time'

    ];
    public function ticket(){
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
