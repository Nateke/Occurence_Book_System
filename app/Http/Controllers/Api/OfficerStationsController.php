<?php

namespace App\Http\Controllers\Api;

use App\Models\Officer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Http\Resources\StationCollection;

class OfficerStationsController extends Controller
{
    public function index(Request $request, Officer $officer): StationCollection
    {
        $this->authorize('view', $officer);

        $search = $request->get('search', '');

        $stations = $officer
            ->stations()
            ->search($search)
            ->latest()
            ->paginate();

        return new StationCollection($stations);
    }

    public function store(Request $request, Officer $officer): StationResource
    {
        $this->authorize('create', Station::class);

        $validated = $request->validate([
            'station_name' => ['required', 'max:255', 'string'],
            'station_number' => ['required', 'max:255', 'string'],
            'region_id' => ['required', 'exists:regions,id'],
            'subregion_id' => ['required', 'max:255'],
            'ward' => ['required', 'max:255'],
            'subcounty_id' => ['required', 'exists:subcounties,id'],
            'ward_id' => ['required', 'exists:wards,id'],
        ]);

        $station = $officer->stations()->create($validated);

        return new StationResource($station);
    }
}
