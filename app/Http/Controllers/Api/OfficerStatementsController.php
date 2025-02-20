<?php

namespace App\Http\Controllers\Api;

use App\Models\Officer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StatementResource;
use App\Http\Resources\StatementCollection;

class OfficerStatementsController extends Controller
{
    public function index(
        Request $request,
        Officer $officer
    ): StatementCollection {
        $this->authorize('view', $officer);

        $search = $request->get('search', '');

        $statements = $officer
            ->statements()
            ->search($search)
            ->latest()
            ->paginate();

        return new StatementCollection($statements);
    }

    public function store(Request $request, Officer $officer): StatementResource
    {
        $this->authorize('create', Statement::class);

        $validated = $request->validate([
            'statement_text' => ['required', 'max:255', 'string'],
            'recording_date' => ['required', 'date'],
            'files_id' => ['required', 'max:255'],
            'booking_id' => ['required', 'max:255'],
        ]);

        $statement = $officer->statements()->create($validated);

        return new StatementResource($statement);
    }
}
