<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\County;
use App\Models\Offender;
use Illuminate\View\View;
use App\Models\Subcounty;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OffenderStoreRequest;
use App\Http\Requests\OffenderUpdateRequest;

class OffenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Offender::class);

        $search = $request->get('search', '');

        $offenders = Offender::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.offenders.index', compact('offenders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Offender::class);

        $counties = County::pluck('name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.offenders.create',
            compact('counties', 'subcounties', 'wards')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OffenderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Offender::class);

        $validated = $request->validated();

        $offender = Offender::create($validated);

        return redirect()
            ->route('offenders.edit', $offender)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Offender $offender): View
    {
        $this->authorize('view', $offender);

        return view('app.offenders.show', compact('offender'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Offender $offender): View
    {
        $this->authorize('update', $offender);

        $counties = County::pluck('name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.offenders.edit',
            compact('offender', 'counties', 'subcounties', 'wards')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OffenderUpdateRequest $request,
        Offender $offender
    ): RedirectResponse {
        $this->authorize('update', $offender);

        $validated = $request->validated();

        $offender->update($validated);

        return redirect()
            ->route('offenders.edit', $offender)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Offender $offender
    ): RedirectResponse {
        $this->authorize('delete', $offender);

        $offender->delete();

        return redirect()
            ->route('offenders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
