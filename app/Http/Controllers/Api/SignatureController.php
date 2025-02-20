<?php

namespace App\Http\Controllers\Api;

use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;
use App\Http\Resources\SignatureCollection;
use App\Http\Requests\SignatureStoreRequest;
use App\Http\Requests\SignatureUpdateRequest;

class SignatureController extends Controller
{
    public function index(Request $request): SignatureCollection
    {
        $this->authorize('view-any', Signature::class);

        $search = $request->get('search', '');

        $signatures = Signature::search($search)
            ->latest()
            ->paginate();

        return new SignatureCollection($signatures);
    }

    public function store(SignatureStoreRequest $request): SignatureResource
    {
        $this->authorize('create', Signature::class);

        $validated = $request->validated();

        $signature = Signature::create($validated);

        return new SignatureResource($signature);
    }

    public function show(
        Request $request,
        Signature $signature
    ): SignatureResource {
        $this->authorize('view', $signature);

        return new SignatureResource($signature);
    }

    public function update(
        SignatureUpdateRequest $request,
        Signature $signature
    ): SignatureResource {
        $this->authorize('update', $signature);

        $validated = $request->validated();

        $signature->update($validated);

        return new SignatureResource($signature);
    }

    public function destroy(Request $request, Signature $signature): Response
    {
        $this->authorize('delete', $signature);

        $signature->delete();

        return response()->noContent();
    }
}
