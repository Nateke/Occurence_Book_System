<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statement extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'statement_text',
        'recorded_by',
        'recording_date',
        'files_id',
        'booking_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'recording_date' => 'datetime',
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'recorded_by');
    }

    public function allStatementFiles()
    {
        return $this->hasMany(StatementFiles::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'offenseCase_id');
    }
}
