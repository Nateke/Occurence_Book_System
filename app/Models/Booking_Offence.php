<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_Offence extends Model
{
    use HasFactory;
    protected $guarded=[''];
    public function booking()
    {
        return $this->hasMany(Booking::class, 'booking_id');
    }


}
