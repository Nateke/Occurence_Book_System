<?php

namespace App\Http\Controllers\Api;

use App\Models\OffenseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffenseCaseResource;
use App\Http\Resources\OffenseCaseCollection;
use App\Http\Requests\OffenseCaseStoreRequest;
use App\Http\Requests\OffenseCaseUpdateRequest;

class OffenseCaseController extends Controller
{
    public function index(Request $request): OffenseCaseCollection
    {
        $this->authorize('view-any', OffenseCase::class);

        $search = $request->get('search', '');

        $offenseCases = OffenseCase::search($search)
            ->latest()
            ->paginate();

        return new OffenseCaseCollection($offenseCases);
    }

    public function store(OffenseCaseStoreRequest $request): OffenseCaseResource
    {
        $this->authorize('create', OffenseCase::class);

        $validated = $request->validated();

        $offenseCase = OffenseCase::create($validated);

        return new OffenseCaseResource($offenseCase);
    }

    public function show(
        Request $request,
        OffenseCase $offenseCase
    ): OffenseCaseResource {
        $this->authorize('view', $offenseCase);

        return new OffenseCaseResource($offenseCase);
    }

    public function update(
        OffenseCaseUpdateRequest $request,
        OffenseCase $offenseCase
    ): OffenseCaseResource {
        $this->authorize('update', $offenseCase);

        $validated = $request->validated();

        $offenseCase->update($validated);

        return new OffenseCaseResource($offenseCase);
    }

    public function destroy(
        Request $request,
        OffenseCase $offenseCase
    ): Response {
        $this->authorize('delete', $offenseCase);

        $offenseCase->delete();

        return response()->noContent();
    }
}
