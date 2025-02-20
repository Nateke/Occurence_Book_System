<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\View\View;
use App\Models\Subcounty;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WardStoreRequest;
use App\Http\Requests\WardUpdateRequest;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Ward::class);

        $search = $request->get('search', '');

        $wards = Ward::search($search)
            ->latest()
            ->paginate(25)
            ->withQueryString();
          $subcounties=Subcounty::orderBy('subcounty_name', 'asc')->get();

        return view('app.wards.index', compact('wards', 'search','subcounties'));
    }
    public function list($subcounty_id)
    {
      info($subcounty_id);
      $this->authorize('view-any', Ward::class);

      $wards = Ward::where('subcounty_id',$subcounty_id)
        ->orderBy('name', 'desc')->get();

      return response()->json($wards);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Ward::class);

        $subcounties = Subcounty::pluck('subcounty_name', 'id');

        return view('app.wards.create', compact('subcounties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WardStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Ward::class);
        $validated = $request->validated();
        Ward::create($validated);

        return redirect()->back()->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ward $ward): View
    {
        $this->authorize('view', $ward);

        return view('app.wards.show', compact('ward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ward $ward): View
    {
        $this->authorize('update', $ward);

        $subcounties = Subcounty::pluck('subcounty_name', 'id');

        return view('app.wards.edit', compact('ward', 'subcounties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WardUpdateRequest $request,
        Ward $ward
    ): RedirectResponse {
        $this->authorize('update', $ward);

        $validated = $request->validated();

        $ward->update($validated);

        return redirect()
            ->route('wards.edit', $ward)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ward $ward): RedirectResponse
    {
        $this->authorize('delete', $ward);

        $ward->delete();

        return redirect()
            ->route('wards.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
