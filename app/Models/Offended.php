<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offended extends Model
{
    use HasFactory;
    use Searchable;
    protected $searchableFields = ['*'];
    protected $table='offended';
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

  public function officer()
  {
    return $this->belongsTo(Officer::class, 'added_by', 'id');
  }
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
  public function ward()
  {
    return $this->belongsTo(Ward::class);
  }

}
