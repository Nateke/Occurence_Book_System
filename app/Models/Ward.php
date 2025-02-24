<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ward extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $guarded=[''];
    protected $fillable = ['subcounty_id', 'name'];

    protected $searchableFields = ['*'];

    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
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
