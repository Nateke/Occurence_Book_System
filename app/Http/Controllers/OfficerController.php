<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OfficerStoreRequest;
use App\Http\Requests\OfficerUpdateRequest;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Officer::class);

        $search = $request->get('search', '');

        $officers = Officer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.officers.index', compact('officers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Officer::class);

        return view('app.officers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfficerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Officer::class);

        $validated = $request->validated();

        $officer = Officer::create($validated);

        return redirect()
            ->route('officers.edit', $officer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Officer $officer): View
    {
        $this->authorize('view', $officer);

        return view('app.officers.show', compact('officer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Officer $officer): View
    {
        $this->authorize('update', $officer);

        return view('app.officers.edit', compact('officer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OfficerUpdateRequest $request,
        Officer $officer
    ): RedirectResponse {
        $this->authorize('update', $officer);

        $validated = $request->validated();

        $officer->update($validated);

        return redirect()
            ->route('officers.edit', $officer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Officer $officer
    ): RedirectResponse {
        $this->authorize('delete', $officer);

        $officer->delete();

        return redirect()
            ->route('officers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
