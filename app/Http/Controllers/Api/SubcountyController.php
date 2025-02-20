<?php

namespace App\Http\Controllers\Api;

use App\Models\Subcounty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubcountyResource;
use App\Http\Resources\SubcountyCollection;
use App\Http\Requests\SubcountyStoreRequest;
use App\Http\Requests\SubcountyUpdateRequest;

class SubcountyController extends Controller
{
    public function index(Request $request): SubcountyCollection
    {
        $this->authorize('view-any', Subcounty::class);

        $search = $request->get('search', '');

        $subcounties = Subcounty::search($search)
            ->latest()
            ->paginate();

        return new SubcountyCollection($subcounties);
    }

    public function store(SubcountyStoreRequest $request): SubcountyResource
    {
        $this->authorize('create', Subcounty::class);

        $validated = $request->validated();

        $subcounty = Subcounty::create($validated);

        return new SubcountyResource($subcounty);
    }

    public function show(
        Request $request,
        Subcounty $subcounty
    ): SubcountyResource {
        $this->authorize('view', $subcounty);

        return new SubcountyResource($subcounty);
    }

    public function update(
        SubcountyUpdateRequest $request,
        Subcounty $subcounty
    ): SubcountyResource {
        $this->authorize('update', $subcounty);

        $validated = $request->validated();

        $subcounty->update($validated);

        return new SubcountyResource($subcounty);
    }

    public function destroy(Request $request, Subcounty $subcounty): Response
    {
        $this->authorize('delete', $subcounty);

        $subcounty->delete();

        return response()->noContent();
    }
}
