<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Witness extends Model
{
    use HasFactory;
    use Searchable;
    protected $table='witness';
    protected $guarded=[''];
    protected $searchableFields = ['*'];

}
