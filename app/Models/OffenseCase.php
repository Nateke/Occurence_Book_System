<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffenseCase extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'booking_id',
        'court_date',
        'legal_adviser_comments',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'offense_cases';

    protected $casts = [
        'court_date' => 'date',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'offenseCase_id');
    }

    public function offenses()
    {
        return $this->hasMany(Offense::class, 'offenseCase_id');
    }
}
