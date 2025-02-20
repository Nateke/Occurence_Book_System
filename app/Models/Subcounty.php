<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcounty extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['county_id', 'subcounty_name'];

    protected $searchableFields = ['*'];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    public function offenders()
    {
        return $this->hasMany(Offender::class);
    }

    public function stations()
    {
        return $this->hasMany(Station::class);
    }
}
