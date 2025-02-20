<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'station_name',
        'station_number',
        'subcounty_id',
        'county_id',
        'ward_id',
    ];

    protected $searchableFields = ['*'];

    public function officers()
    {
        return $this->hasMany(Officer::class, 'station_id');
    }

    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
