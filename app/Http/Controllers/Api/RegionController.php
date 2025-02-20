<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use App\Http\Resources\RegionCollection;
use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;

class RegionController extends Controller
{
    public function index(Request $request): RegionCollection
    {
        $this->authorize('view-any', Region::class);

        $search = $request->get('search', '');

        $regions = Region::search($search)
            ->latest()
            ->paginate();

        return new RegionCollection($regions);
    }

    public function store(RegionStoreRequest $request): RegionResource
    {
        $this->authorize('create', Region::class);

        $validated = $request->validated();

        $region = Region::create($validated);

        return new RegionResource($region);
    }

    public function show(Request $request, Region $region): RegionResource
    {
        $this->authorize('view', $region);

        return new RegionResource($region);
    }

    public function update(
        RegionUpdateRequest $request,
        Region $region
    ): RegionResource {
        $this->authorize('update', $region);

        $validated = $request->validated();

        $region->update($validated);

        return new RegionResource($region);
    }

    public function destroy(Request $request, Region $region): Response
    {
        $this->authorize('delete', $region);

        $region->delete();

        return response()->noContent();
    }
}
