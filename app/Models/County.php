<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public function subcounties()
    {
        return $this->hasMany(Subcounty::class);
    }
    public function stations()
    {
        return $this->hasMany(Station::class);
    }

    public function offenders()
    {
        return $this->hasMany(Offender::class);
    }
}
