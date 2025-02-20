<?php

namespace App\Http\Controllers;

use App\Models\Offense;
use Illuminate\View\View;
use App\Models\OffenseCase;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OffenseStoreRequest;
use App\Http\Requests\OffenseUpdateRequest;

class OffenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Offense::class);

        $search = $request->get('search', '');

        $offenses = Offense::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.offenses.index', compact('offenses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Offense::class);

        $offenseCases = OffenseCase::pluck('court_date', 'id');

        return view('app.offenses.create', compact('offenseCases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OffenseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Offense::class);

        $validated = $request->validated();

        $offense = Offense::create($validated);

        return redirect()
            ->route('offenses.edit', $offense)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Offense $offense): View
    {
        $this->authorize('view', $offense);

        return view('app.offenses.show', compact('offense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Offense $offense): View
    {
        $this->authorize('update', $offense);

        $offenseCases = OffenseCase::pluck('court_date', 'id');

        return view('app.offenses.edit', compact('offense', 'offenseCases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OffenseUpdateRequest $request,
        Offense $offense
    ): RedirectResponse {
        $this->authorize('update', $offense);

        $validated = $request->validated();

        $offense->update($validated);

        return redirect()
            ->route('offenses.edit', $offense)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Offense $offense
    ): RedirectResponse {
        $this->authorize('delete', $offense);

        $offense->delete();

        return redirect()
            ->route('offenses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
