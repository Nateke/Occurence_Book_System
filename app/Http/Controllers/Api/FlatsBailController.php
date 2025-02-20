<?php

namespace App\Http\Controllers\Api;

use App\Models\FlatsBail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FlatsBailResource;
use App\Http\Resources\FlatsBailCollection;
use App\Http\Requests\FlatsBailStoreRequest;
use App\Http\Requests\FlatsBailUpdateRequest;

class FlatsBailController extends Controller
{
    public function index(Request $request): FlatsBailCollection
    {
        $this->authorize('view-any', FlatsBail::class);

        $search = $request->get('search', '');

        $flatsBails = FlatsBail::search($search)
            ->latest()
            ->paginate();

        return new FlatsBailCollection($flatsBails);
    }

    public function store(FlatsBailStoreRequest $request): FlatsBailResource
    {
        $this->authorize('create', FlatsBail::class);

        $validated = $request->validated();

        $flatsBail = FlatsBail::create($validated);

        return new FlatsBailResource($flatsBail);
    }

    public function show(
        Request $request,
        FlatsBail $flatsBail
    ): FlatsBailResource {
        $this->authorize('view', $flatsBail);

        return new FlatsBailResource($flatsBail);
    }

    public function update(
        FlatsBailUpdateRequest $request,
        FlatsBail $flatsBail
    ): FlatsBailResource {
        $this->authorize('update', $flatsBail);

        $validated = $request->validated();

        $flatsBail->update($validated);

        return new FlatsBailResource($flatsBail);
    }

    public function destroy(Request $request, FlatsBail $flatsBail): Response
    {
        $this->authorize('delete', $flatsBail);

        $flatsBail->delete();

        return response()->noContent();
    }
}
