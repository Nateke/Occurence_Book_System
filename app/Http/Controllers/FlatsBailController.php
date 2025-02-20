<?php

namespace App\Http\Controllers;

use App\Models\FlatsBail;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FlatsBailStoreRequest;
use App\Http\Requests\FlatsBailUpdateRequest;

class FlatsBailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', FlatsBail::class);

        $search = $request->get('search', '');

        $flatsBails = FlatsBail::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.flats_bails.index', compact('flatsBails', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', FlatsBail::class);

        return view('app.flats_bails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FlatsBailStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', FlatsBail::class);

        $validated = $request->validated();

        $flatsBail = FlatsBail::create($validated);

        return redirect()
            ->route('flats-bails.edit', $flatsBail)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, FlatsBail $flatsBail): View
    {
        $this->authorize('view', $flatsBail);

        return view('app.flats_bails.show', compact('flatsBail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FlatsBail $flatsBail): View
    {
        $this->authorize('update', $flatsBail);

        return view('app.flats_bails.edit', compact('flatsBail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FlatsBailUpdateRequest $request,
        FlatsBail $flatsBail
    ): RedirectResponse {
        $this->authorize('update', $flatsBail);

        $validated = $request->validated();

        $flatsBail->update($validated);

        return redirect()
            ->route('flats-bails.edit', $flatsBail)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        FlatsBail $flatsBail
    ): RedirectResponse {
        $this->authorize('delete', $flatsBail);

        $flatsBail->delete();

        return redirect()
            ->route('flats-bails.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
