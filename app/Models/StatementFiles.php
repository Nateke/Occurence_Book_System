<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatementFiles extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['file_url', 'statement_id'];

    protected $searchableFields = ['*'];

    protected $table = 'statement_files';

    public function statement()
    {
        return $this->belongsTo(Statement::class);
    }
}
