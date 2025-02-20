<?php

namespace App\Http\Controllers\Api;

use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\StatementResource;
use App\Http\Resources\StatementCollection;
use App\Http\Requests\StatementStoreRequest;
use App\Http\Requests\StatementUpdateRequest;

class StatementController extends Controller
{
    public function index(Request $request): StatementCollection
    {
        $this->authorize('view-any', Statement::class);

        $search = $request->get('search', '');

        $statements = Statement::search($search)
            ->latest()
            ->paginate();

        return new StatementCollection($statements);
    }

    public function store(StatementStoreRequest $request): StatementResource
    {
        $this->authorize('create', Statement::class);

        $validated = $request->validated();

        $statement = Statement::create($validated);

        return new StatementResource($statement);
    }

    public function show(
        Request $request,
        Statement $statement
    ): StatementResource {
        $this->authorize('view', $statement);

        return new StatementResource($statement);
    }

    public function update(
        StatementUpdateRequest $request,
        Statement $statement
    ): StatementResource {
        $this->authorize('update', $statement);

        $validated = $request->validated();

        $statement->update($validated);

        return new StatementResource($statement);
    }

    public function destroy(Request $request, Statement $statement): Response
    {
        $this->authorize('delete', $statement);

        $statement->delete();

        return response()->noContent();
    }
}
