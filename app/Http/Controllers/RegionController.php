<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Region::class);

        $search = $request->get('search', '');

        $regions = Region::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.regions.index', compact('regions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Region::class);

        return view('app.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Region::class);

        $validated = $request->validated();

        $region = Region::create($validated);

        return redirect()
            ->route('regions.edit', $region)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Region $region): View
    {
        $this->authorize('view', $region);

        return view('app.regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Region $region): View
    {
        $this->authorize('update', $region);

        return view('app.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RegionUpdateRequest $request,
        Region $region
    ): RedirectResponse {
        $this->authorize('update', $region);

        $validated = $request->validated();

        $region->update($validated);

        return redirect()
            ->route('regions.edit', $region)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Region $region): RedirectResponse
    {
        $this->authorize('delete', $region);

        $region->delete();

        return redirect()
            ->route('regions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
