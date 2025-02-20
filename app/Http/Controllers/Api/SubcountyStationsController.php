<?php

namespace App\Http\Controllers\Api;

use App\Models\Subcounty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Http\Resources\StationCollection;

class SubcountyStationsController extends Controller
{
    public function index(
        Request $request,
        Subcounty $subcounty
    ): StationCollection {
        $this->authorize('view', $subcounty);

        $search = $request->get('search', '');

        $stations = $subcounty
            ->stations()
            ->search($search)
            ->latest()
            ->paginate();

        return new StationCollection($stations);
    }

    public function store(
        Request $request,
        Subcounty $subcounty
    ): StationResource {
        $this->authorize('create', Station::class);

        $validated = $request->validate([
            'station_name' => ['required', 'max:255', 'string'],
            'station_number' => ['required', 'max:255', 'string'],
            'region_id' => ['required', 'exists:regions,id'],
            'subregion_id' => ['required', 'max:255'],
            'ward' => ['required', 'max:255'],
            'station_id' => ['required', 'exists:officers,id'],
            'ward_id' => ['required', 'exists:wards,id'],
        ]);

        $station = $subcounty->stations()->create($validated);

        return new StationResource($station);
    }
}
