<?php

namespace App\Http\Controllers\Api;

use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\WardResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\WardCollection;
use App\Http\Requests\WardStoreRequest;
use App\Http\Requests\WardUpdateRequest;

class WardController extends Controller
{
    public function index(Request $request): WardCollection
    {
        $this->authorize('view-any', Ward::class);

        $search = $request->get('search', '');

        $wards = Ward::search($search)
            ->latest()
            ->paginate();

        return new WardCollection($wards);
    }

    public function store(WardStoreRequest $request): WardResource
    {
        $this->authorize('create', Ward::class);

        $validated = $request->validated();

        $ward = Ward::create($validated);

        return new WardResource($ward);
    }

    public function show(Request $request, Ward $ward): WardResource
    {
        $this->authorize('view', $ward);

        return new WardResource($ward);
    }

    public function update(WardUpdateRequest $request, Ward $ward): WardResource
    {
        $this->authorize('update', $ward);

        $validated = $request->validated();

        $ward->update($validated);

        return new WardResource($ward);
    }

    public function destroy(Request $request, Ward $ward): Response
    {
        $this->authorize('delete', $ward);

        $ward->delete();

        return response()->noContent();
    }
}
