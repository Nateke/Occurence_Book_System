<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'officer_id',
        'booking_date',
        'booking_time',
        'location',
        'remarks',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }

    public function signature()
    {
        return $this->belongsTo(Signature::class, 'offenseCase_id');
    }

    public function statement()
    {
        return $this->belongsTo(Statement::class, 'offenseCase_id');
    }

    public function flatsBail()
    {
        return $this->belongsTo(FlatsBail::class, 'offenseCase_id');
    }

    public function offenseCase()
    {
        return $this->belongsTo(OffenseCase::class, 'offenseCase_id');
    }

    public function offended()
    {
        return $this->belongsToMany(Offended::class, 'booking_offended', 'booking_id', 'offended_id');
    }
    public function offender()
    {
        return $this->belongsToMany(Offender::class, 'booking_offenders', 'booking_id', 'offended_id');
    }

    public function witnesses()
    {
        return $this->belongsToMany(Witness::class, 'booking_witnesses', 'booking_id', 'witness_id');
    }

}
