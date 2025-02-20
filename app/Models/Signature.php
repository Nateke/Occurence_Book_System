<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Signature extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'booking_id',
        'signature_date',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'signature_date' => 'datetime',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'offenseCase_id');
    }
}
