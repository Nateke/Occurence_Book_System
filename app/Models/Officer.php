<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Officer extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'station_id',
        'user_id',
        'officer_name',
        'badge_number',
        'rank',
        'gender'
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
      return $this->hasMany(Booking::class);
    }

    public function statements()
    {
        return $this->hasMany(Statement::class, 'recorded_by');
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
  public function county()
  {
    return $this->belongsTo(County::class);
  }
  public function country()
  {
    return $this->belongsTo(Country::class, 'nationality', 'id');
  }
  public function subcounty()
  {
    return $this->belongsTo(Subcounty::class);
  }
  public function ward()
  {
    return $this->belongsTo(Ward::class);
  }

}
