<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offender extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'other_name',
        'id_scan',
        'dob',
        'gender',
        'underage_flag',
        'phone_number',
        'country_id',
        'county_id',
        'subcounty_id',
        'ward_id',
        'location',
        'address',
        'added_by',

    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'underage_flag' => 'boolean',
    ];

    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'offenseCase_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
    public function officer()
    {
        return $this->belongsTo(Officer::class, 'added_by', 'id');
    }
}
