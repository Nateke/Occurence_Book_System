<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Subcounty;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubcountyStoreRequest;
use App\Http\Requests\SubcountyUpdateRequest;

class SubcountyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Subcounty::class);

        $search = $request->get('search', '');

        $subcounties = Subcounty::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.subcounties.index', compact('subcounties', 'search'));
    }
    public function list(Request $request, $county_id)
    {
      $this->authorize('view-any', Subcounty::class);
      $subcounties= Subcounty::where('county_id',$county_id)
        ->orderBy('subcounty_name', 'desc') ->get();
      return response()->json($subcounties);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Subcounty::class);

        $counties = County::pluck('name', 'id');

        return view('app.subcounties.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcountyStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Subcounty::class);

        $validated = $request->validated();

        $subcounty = Subcounty::create($validated);

        return redirect()
            ->route('subcounties.edit', $subcounty)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Subcounty $subcounty): View
    {
        $this->authorize('view', $subcounty);

        return view('app.subcounties.show', compact('subcounty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Subcounty $subcounty): View
    {
        $this->authorize('update', $subcounty);

        $counties = County::pluck('name', 'id');

        return view('app.subcounties.edit', compact('subcounty', 'counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubcountyUpdateRequest $request,
        Subcounty $subcounty
    ): RedirectResponse {
        $this->authorize('update', $subcounty);

        $validated = $request->validated();

        $subcounty->update($validated);

        return redirect()
            ->route('subcounties.edit', $subcounty)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Subcounty $subcounty
    ): RedirectResponse {
        $this->authorize('delete', $subcounty);

        $subcounty->delete();

        return redirect()
            ->route('subcounties.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
