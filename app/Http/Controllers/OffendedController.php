<?php

namespace App\Http\Controllers;

use App\Http\Requests\OffendedStoreRequest;
use App\Http\Requests\OffendedUpdateRequest;
use App\Models\County;
use App\Models\Offended;
use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OffendedController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-any', Offended::class);

        $search = $request->get('search', '');

        $offended = Offended::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.offended.index', compact('offended', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Offended::class);

        $counties = County::pluck('name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.offended.create',
            compact('counties', 'subcounties', 'wards')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OffendedStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Offended::class);

        $validated = $request->validated();

        $offended = Offended::create($validated);

        return redirect()
            ->route('offended.edit', $offended)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Offended $offended): View
    {
        $this->authorize('view', $offended);

        return view('app.offended.show', compact('offended'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Offended $offended): View
    {
        $this->authorize('update', $offended);

        $counties = County::pluck('name', 'id');
        $subcounties = Subcounty::pluck('subcounty_name', 'id');
        $wards = Ward::pluck('name', 'id');

        return view(
            'app.offended.edit',
            compact('offended', 'counties', 'subcounties', 'wards')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OffendedUpdateRequest $request,
        Offended $offended
    ): RedirectResponse {
        $this->authorize('update', $offended);

        $validated = $request->validated();

        $offended->update($validated);

        return redirect()
            ->route('offended.edit', $offended)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Offended $offended
    ): RedirectResponse {
        $this->authorize('delete', $offended);

        $offended->delete();

        return redirect()
            ->route('offended.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
