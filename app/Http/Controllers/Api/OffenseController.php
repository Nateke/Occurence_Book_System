<?php

namespace App\Http\Controllers\Api;

use App\Models\Offense;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffenseResource;
use App\Http\Resources\OffenseCollection;
use App\Http\Requests\OffenseStoreRequest;
use App\Http\Requests\OffenseUpdateRequest;

class OffenseController extends Controller
{
    public function index(Request $request): OffenseCollection
    {
        $this->authorize('view-any', Offense::class);

        $search = $request->get('search', '');

        $offenses = Offense::search($search)
            ->latest()
            ->paginate();

        return new OffenseCollection($offenses);
    }

    public function store(OffenseStoreRequest $request): OffenseResource
    {
        $this->authorize('create', Offense::class);

        $validated = $request->validated();

        $offense = Offense::create($validated);

        return new OffenseResource($offense);
    }

    public function show(Request $request, Offense $offense): OffenseResource
    {
        $this->authorize('view', $offense);

        return new OffenseResource($offense);
    }

    public function update(
        OffenseUpdateRequest $request,
        Offense $offense
    ): OffenseResource {
        $this->authorize('update', $offense);

        $validated = $request->validated();

        $offense->update($validated);

        return new OffenseResource($offense);
    }

    public function destroy(Request $request, Offense $offense): Response
    {
        $this->authorize('delete', $offense);

        $offense->delete();

        return response()->noContent();
    }
}
