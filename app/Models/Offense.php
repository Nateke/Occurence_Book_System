<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offense extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'offence_name',
        'description',
        'fine_amount',
        'imprisonment_duration',
        'offenseCase_id',
    ];

    protected $searchableFields = ['*'];

    public function offenseCase()
    {
        return $this->belongsTo(OffenseCase::class, 'offenseCase_id');
    }
}
