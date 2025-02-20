<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CountyStoreRequest;
use App\Http\Requests\CountyUpdateRequest;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', County::class);

        $search = $request->get('search', '');

        $counties = County::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.counties.index', compact('counties', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', County::class);

        return view('app.counties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountyStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', County::class);

        $validated = $request->validated();

        $county = County::create($validated);

        return redirect()
            ->route('counties.edit', $county)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, County $county): View
    {
        $this->authorize('view', $county);

        return view('app.counties.show', compact('county'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, County $county): View
    {
        $this->authorize('update', $county);

        return view('app.counties.edit', compact('county'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CountyUpdateRequest $request,
        County $county
    ): RedirectResponse {
        $this->authorize('update', $county);

        $validated = $request->validated();

        $county->update($validated);

        return redirect()
            ->route('counties.edit', $county)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, County $county): RedirectResponse
    {
        $this->authorize('delete', $county);

        $county->delete();

        return redirect()
            ->route('counties.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
