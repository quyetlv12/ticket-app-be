<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "ratings";
    protected $guarded = [];

    public function Buses()
    {
        return $this->belongsTo(Buses::class);
    }

    /**
     * Get the user that made the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
