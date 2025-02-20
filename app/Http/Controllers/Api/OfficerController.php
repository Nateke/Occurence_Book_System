<?php

namespace App\Http\Controllers\Api;

use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfficerResource;
use App\Http\Resources\OfficerCollection;
use App\Http\Requests\OfficerStoreRequest;
use App\Http\Requests\OfficerUpdateRequest;

class OfficerController extends Controller
{
    public function index(Request $request): OfficerCollection
    {
        $this->authorize('view-any', Officer::class);

        $search = $request->get('search', '');

        $officers = Officer::search($search)
            ->latest()
            ->paginate();

        return new OfficerCollection($officers);
    }

    public function store(OfficerStoreRequest $request): OfficerResource
    {
        $this->authorize('create', Officer::class);

        $validated = $request->validated();

        $officer = Officer::create($validated);

        return new OfficerResource($officer);
    }

    public function show(Request $request, Officer $officer): OfficerResource
    {
        $this->authorize('view', $officer);

        return new OfficerResource($officer);
    }

    public function update(
        OfficerUpdateRequest $request,
        Officer $officer
    ): OfficerResource {
        $this->authorize('update', $officer);

        $validated = $request->validated();

        $officer->update($validated);

        return new OfficerResource($officer);
    }

    public function destroy(Request $request, Officer $officer): Response
    {
        $this->authorize('delete', $officer);

        $officer->delete();

        return response()->noContent();
    }
}
