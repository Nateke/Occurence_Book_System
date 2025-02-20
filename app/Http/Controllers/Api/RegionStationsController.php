<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Http\Resources\StationCollection;

class RegionStationsController extends Controller
{
    public function index(Request $request, Region $region): StationCollection
    {
        $this->authorize('view', $region);

        $search = $request->get('search', '');

        $stations = $region
            ->stations()
            ->search($search)
            ->latest()
            ->paginate();

        return new StationCollection($stations);
    }

    public function store(Request $request, Region $region): StationResource
    {
        $this->authorize('create', Station::class);

        $validated = $request->validate([
            'station_name' => ['required', 'max:255', 'string'],
            'station_number' => ['required', 'max:255', 'string'],
            'subregion_id' => ['required', 'max:255'],
            'ward' => ['required', 'max:255'],
            'station_id' => ['required', 'exists:officers,id'],
            'subcounty_id' => ['required', 'exists:subcounties,id'],
            'ward_id' => ['required', 'exists:wards,id'],
        ]);

        $station = $region->stations()->create($validated);

        return new StationResource($station);
    }
}
