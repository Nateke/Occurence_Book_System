<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlatsBail extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'conditions',
        'release_date',
        'surety_details',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'flats_bails';

    protected $casts = [
        'release_date' => 'datetime',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'booking_id');
    }
}
