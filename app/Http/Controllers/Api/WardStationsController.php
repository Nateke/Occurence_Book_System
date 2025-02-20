<?php

namespace App\Http\Controllers\Api;

use App\Models\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationResource;
use App\Http\Resources\StationCollection;

class WardStationsController extends Controller
{
    public function index(Request $request, Ward $ward): StationCollection
    {
        $this->authorize('view', $ward);

        $search = $request->get('search', '');

        $stations = $ward
            ->stations()
            ->search($search)
            ->latest()
            ->paginate();

        return new StationCollection($stations);
    }

    public function store(Request $request, Ward $ward): StationResource
    {
        $this->authorize('create', Station::class);

        $validated = $request->validate([
            'station_name' => ['required', 'max:255', 'string'],
            'station_number' => ['required', 'max:255', 'string'],
            'region_id' => ['required', 'exists:regions,id'],
            'subregion_id' => ['required', 'max:255'],
            'ward' => ['required', 'max:255'],
            'station_id' => ['required', 'exists:officers,id'],
            'subcounty_id' => ['required', 'exists:subcounties,id'],
        ]);

        $station = $ward->stations()->create($validated);

        return new StationResource($station);
    }
}
