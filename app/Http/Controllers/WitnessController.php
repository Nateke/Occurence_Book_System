<?php

namespace App\Http\Controllers;

use App\Http\Requests\WitnessStoreRequest;
use App\Http\Requests\WitnessUpdateRequest;
use App\Models\County;
use App\Models\Witness;
use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WitnessController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('view-any', Witness::class);

        $search = $request->get('search', '');

        $witnesss = Witness::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.witness.index', compact('witnesss', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Witness::class);

        $counties = County::pluck('name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.witness.create',
            compact('counties', 'subcounties', 'wards')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WitnessStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Witness::class);

        $validated = $request->validated();

        $witness = Witness::create($validated);

        return redirect()
            ->route('witness.edit', $witness)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Witness $witness): View
    {
        $this->authorize('view', $witness);

        return view('app.witness.show', compact('witness'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Witness $witness): View
    {
        $this->authorize('update', $witness);

        $counties = County::pluck('name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.witness.edit',
            compact('witness', 'counties', 'subcounties', 'wards')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WitnessUpdateRequest $request,
        Witness              $witness
    ): RedirectResponse
    {
        $this->authorize('update', $witness);

        $validated = $request->validated();

        $witness->update($validated);

        return redirect()
            ->route('witness.edit', $witness)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request  $request,
        Witness $witness
    ): RedirectResponse
    {
        $this->authorize('delete', $witness);

        $witness->delete();

        return redirect()
            ->route('witness.index')
            ->withSuccess(__('crud.common.removed'));
    }

}
