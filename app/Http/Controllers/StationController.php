<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\County;
use App\Models\Ward;
use App\Models\Region;
use App\Models\Station;
use App\Models\Officer;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Subcounty;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StationStoreRequest;
use App\Http\Requests\StationUpdateRequest;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Station::class);

        $search = $request->get('search', '');

        $stations = Station::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();
      $counties = County::orderBy('name', 'asc')->get();
        return view('app.stations.index', compact('stations', 'search', 'counties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Station::class);

        $county = County::pluck('name', 'id');
        $officers = Officer::pluck('officer_name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.stations.create',
            compact('county', 'officers', 'subcounties', 'wards')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
  {
    $this->authorize('create', Station::class);

    try {
      $request->validate([
        'station_name' => ['required', 'max:255', 'string'],
        'county_id' => ['required', 'exists:counties,id'],
        'subcounty_id' => ['required', 'exists:subcounties,id'],
        'ward_id' => ['required', 'exists:wards,id'],
      ]);

   Station::create([
        'station_name' => $request->input('station_name'),
        'station_number' => Str::random(24),
        'county_id' => $request->input('county_id'),
        'subregion_id' => $request->input('subregion_id'),
        'subcounty_id' => $request->input('subcounty_id'),
        'ward_id' => $request->input('ward_id'),
        'location' => $request->input('location'),
        'sublocation' => $request->input('sublocation'),
        'address' => $request->input('address'),
      ]);

      return redirect()
        ->back()
        ->withSuccess(__('crud.common.created'));
    } catch (ValidationException $e) {
      $errors = collect($e->errors())->flatten()->all();
//      return redirect()->back()->withErrors($errors)->withInput();
      return response()->json([
        'error' => 'Validation failed. Please check the form for errors.',
        'errors' => $errors,
      ], 422);
    }
  }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, Station $station): View
    {
        $this->authorize('view', $station);

        return view('app.stations.show', compact('station'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Station $station): View
    {
        $this->authorize('update', $station);

        $regions = Region::pluck('name', 'id');
        $officers = Officer::pluck('officer_name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.stations.edit',
            compact('station', 'regions', 'officers', 'subcounties', 'wards')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StationUpdateRequest $request,
        Station $station
    ): RedirectResponse {
        $this->authorize('update', $station);

        $validated = $request->validated();

        $station->update($validated);

        return redirect()
            ->route('stations.edit', $station)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Station $station
    ): RedirectResponse {
        $this->authorize('delete', $station);

        $station->delete();

        return redirect()
            ->route('stations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
