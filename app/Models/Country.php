<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = [
        'iso',
        'name',
        'nicename',
        'iso3',
        'numcode',
        'phonecode',
    ];
    protected $searchableFields = ['*'];
}
