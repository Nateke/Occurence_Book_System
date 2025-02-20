<?php

namespace App\Http\Controllers\Api;

use App\Models\Witness;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WitnessResource;
use App\Http\Resources\WitnessCollection;
use App\Http\Requests\WitnessStoreRequest;
use App\Http\Requests\WitnessUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WitnessController extends Controller
{
    public function index(Request $request): WitnessCollection
    {
        $this->authorize('view-any', Witness::class);

        $search = $request->get('search', '');

        $offenders = Witness::where('added_by',Auth::user()->id)->search($search)
            ->latest()
            ->paginate();

        return new WitnessCollection($offenders);
    }
    public function all(Request $request): WitnessCollection
    {
        $this->authorize('view-any', Witness::class);

        $search = $request->get('search', '');

        $offenders = Witness::search($search)
            ->latest()
            ->paginate();

        return new WitnessCollection($offenders);
    }

    public function store(WitnessStoreRequest $request): WitnessResource
    {
        $this->authorize('create', Witness::class);
        $validated = $request->validated();
        $validated['added_by'] = Auth::id();

        try {
            $offender = Witness::create($validated);
            return new WitnessResource($offender);
        }
        catch (\Exception $e) {
            return new WitnessResource(['error' => 'Failed to create offender.', 'details'=>$e], 500);
        }
    }

    public function show(Request $request, Witness $offender): WitnessResource
    {
        $this->authorize('view', $offender);

        return new WitnessResource($offender);
    }

    public function update(
        WitnessUpdateRequest $request,
        Witness $offender
    ): WitnessResource {
        $this->authorize('update', $offender);

        $validated = $request->validated();
        $offender->update($validated);

        return new WitnessResource($offender);
    }

    public function destroy(Request $request, Witness $offender): Response
    {
        $this->authorize('delete', $offender);

        $offender->delete();

        return response()->noContent();
    }
}
