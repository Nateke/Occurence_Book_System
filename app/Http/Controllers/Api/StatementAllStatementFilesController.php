<?php

namespace App\Http\Controllers\Api;

use App\Models\Statement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StatementFilesResource;
use App\Http\Resources\StatementFilesCollection;

class StatementAllStatementFilesController extends Controller
{
    public function index(
        Request $request,
        Statement $statement
    ): StatementFilesCollection {
        $this->authorize('view', $statement);

        $search = $request->get('search', '');

        $allStatementFiles = $statement
            ->allStatementFiles()
            ->search($search)
            ->latest()
            ->paginate();

        return new StatementFilesCollection($allStatementFiles);
    }

    public function store(
        Request $request,
        Statement $statement
    ): StatementFilesResource {
        $this->authorize('create', StatementFiles::class);

        $validated = $request->validate([
            'file_url' => ['required', 'max:255', 'string'],
        ]);

        $statementFiles = $statement->allStatementFiles()->create($validated);

        return new StatementFilesResource($statementFiles);
    }
}
