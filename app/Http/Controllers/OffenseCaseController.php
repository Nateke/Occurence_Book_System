<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\OffenseCase;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OffenseCaseStoreRequest;
use App\Http\Requests\OffenseCaseUpdateRequest;

class OffenseCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', OffenseCase::class);

        $search = $request->get('search', '');

        $offenseCases = OffenseCase::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.offense_cases.index',
            compact('offenseCases', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', OffenseCase::class);

        return view('app.offense_cases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OffenseCaseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', OffenseCase::class);

        $validated = $request->validated();

        $offenseCase = OffenseCase::create($validated);

        return redirect()
            ->route('offense-cases.edit', $offenseCase)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, OffenseCase $offenseCase): View
    {
        $this->authorize('view', $offenseCase);

        return view('app.offense_cases.show', compact('offenseCase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, OffenseCase $offenseCase): View
    {
        $this->authorize('update', $offenseCase);

        return view('app.offense_cases.edit', compact('offenseCase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OffenseCaseUpdateRequest $request,
        OffenseCase $offenseCase
    ): RedirectResponse {
        $this->authorize('update', $offenseCase);

        $validated = $request->validated();

        $offenseCase->update($validated);

        return redirect()
            ->route('offense-cases.edit', $offenseCase)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        OffenseCase $offenseCase
    ): RedirectResponse {
        $this->authorize('delete', $offenseCase);

        $offenseCase->delete();

        return redirect()
            ->route('offense-cases.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
