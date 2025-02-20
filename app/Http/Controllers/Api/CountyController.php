<?php

namespace App\Http\Controllers\Api;

use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountyResource;
use App\Http\Resources\CountyCollection;
use App\Http\Requests\CountyStoreRequest;
use App\Http\Requests\CountyUpdateRequest;

class CountyController extends Controller
{
    public function index(Request $request): CountyCollection
    {
        $this->authorize('view-any', County::class);

        $search = $request->get('search', '');

        $counties = County::search($search)
            ->latest()
            ->paginate();

        return new CountyCollection($counties);
    }

    public function store(CountyStoreRequest $request): CountyResource
    {
        $this->authorize('create', County::class);

        $validated = $request->validated();

        $county = County::create($validated);

        return new CountyResource($county);
    }

    public function show(Request $request, County $county): CountyResource
    {
        $this->authorize('view', $county);

        return new CountyResource($county);
    }

    public function update(
        CountyUpdateRequest $request,
        County $county
    ): CountyResource {
        $this->authorize('update', $county);

        $validated = $request->validated();

        $county->update($validated);

        return new CountyResource($county);
    }

    public function destroy(Request $request, County $county): Response
    {
        $this->authorize('delete', $county);

        $county->delete();

        return response()->noContent();
    }
}
