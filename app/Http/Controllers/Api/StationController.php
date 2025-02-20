<?php

namespace App\Http\Controllers\Api;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Http\Resources\StationCollection;
use App\Http\Requests\StationStoreRequest;
use App\Http\Requests\StationUpdateRequest;

class StationController extends Controller
{
    public function index(Request $request): StationCollection
    {
        $this->authorize('view-any', Station::class);

        $search = $request->get('search', '');

        $stations = Station::search($search)
            ->latest()
            ->paginate();

        return new StationCollection($stations);
    }

    public function store(StationStoreRequest $request): StationResource
    {
        $this->authorize('create', Station::class);

        $validated = $request->validated();

        $station = Station::create($validated);

        return new StationResource($station);
    }

    public function show(Request $request, Station $station): StationResource
    {
        $this->authorize('view', $station);

        return new StationResource($station);
    }

    public function update(
        StationUpdateRequest $request,
        Station $station
    ): StationResource {
        $this->authorize('update', $station);

        $validated = $request->validated();

        $station->update($validated);

        return new StationResource($station);
    }

    public function destroy(Request $request, Station $station): Response
    {
        $this->authorize('delete', $station);

        $station->delete();

        return response()->noContent();
    }
}
