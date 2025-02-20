<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SignatureStoreRequest;
use App\Http\Requests\SignatureUpdateRequest;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Signature::class);

        $search = $request->get('search', '');

        $signatures = Signature::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.signatures.index', compact('signatures', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Signature::class);

        return view('app.signatures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SignatureStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Signature::class);

        $validated = $request->validated();

        $signature = Signature::create($validated);

        return redirect()
            ->route('signatures.edit', $signature)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Signature $signature): View
    {
        $this->authorize('view', $signature);

        return view('app.signatures.show', compact('signature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Signature $signature): View
    {
        $this->authorize('update', $signature);

        return view('app.signatures.edit', compact('signature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SignatureUpdateRequest $request,
        Signature $signature
    ): RedirectResponse {
        $this->authorize('update', $signature);

        $validated = $request->validated();

        $signature->update($validated);

        return redirect()
            ->route('signatures.edit', $signature)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Signature $signature
    ): RedirectResponse {
        $this->authorize('delete', $signature);

        $signature->delete();

        return redirect()
            ->route('signatures.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
