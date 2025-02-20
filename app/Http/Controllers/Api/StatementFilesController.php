<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StatementFiles;
use App\Http\Controllers\Controller;
use App\Http\Resources\StatementFilesResource;
use App\Http\Resources\StatementFilesCollection;
use App\Http\Requests\StatementFilesStoreRequest;
use App\Http\Requests\StatementFilesUpdateRequest;

class StatementFilesController extends Controller
{
    public function index(Request $request): StatementFilesCollection
    {
        $this->authorize('view-any', StatementFiles::class);

        $search = $request->get('search', '');

        $allStatementFiles = StatementFiles::search($search)
            ->latest()
            ->paginate();

        return new StatementFilesCollection($allStatementFiles);
    }

    public function store(
        StatementFilesStoreRequest $request
    ): StatementFilesResource {
        $this->authorize('create', StatementFiles::class);

        $validated = $request->validated();

        $statementFiles = StatementFiles::create($validated);

        return new StatementFilesResource($statementFiles);
    }

    public function show(
        Request $request,
        StatementFiles $statementFiles
    ): StatementFilesResource {
        $this->authorize('view', $statementFiles);

        return new StatementFilesResource($statementFiles);
    }

    public function update(
        StatementFilesUpdateRequest $request,
        StatementFiles $statementFiles
    ): StatementFilesResource {
        $this->authorize('update', $statementFiles);

        $validated = $request->validated();

        $statementFiles->update($validated);

        return new StatementFilesResource($statementFiles);
    }

    public function destroy(
        Request $request,
        StatementFiles $statementFiles
    ): Response {
        $this->authorize('delete', $statementFiles);

        $statementFiles->delete();

        return response()->noContent();
    }
}
