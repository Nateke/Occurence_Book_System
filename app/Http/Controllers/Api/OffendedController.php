<?php

namespace App\Http\Controllers\Api;

use App\Models\Offended;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffendedResource;
use App\Http\Resources\OffendedCollection;
use App\Http\Requests\OffendedStoreRequest;
use App\Http\Requests\OffendedUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OffendedController extends Controller
{
    public function index(Request $request): OffendedCollection
    {
        $this->authorize('view-any', Offended::class);

        $search = $request->get('search', '');

        $offenders = Offended::where('added_by',Auth::user()->id)->search($search)
            ->latest()
            ->get();

        return new OffendedCollection($offenders);
    }
    public function all(Request $request): OffendedCollection
    {
        $this->authorize('view-any', Offended::class);

        $search = $request->get('search', '');

        $offenders = Offended::search($search)
            ->latest()
            ->get();

        return new OffendedCollection($offenders);
    }

    public function store(OffendedStoreRequest $request): OffendedResource
    {
        $this->authorize('create', Offended::class);
        $validated = $request->validated();
        $validated['added_by'] = Auth::id();

        try {
            $offender = Offended::create($validated);
            return new OffendedResource($offender);
        }
        catch (\Exception $e) {
            return new OffendedResource(['error' => 'Failed to create offender.', 'details'=>$e], 500);
        }
    }

    public function show(Request $request, Offended $offender): OffendedResource
    {
        $this->authorize('view', $offender);

        return new OffendedResource($offender);
    }

    public function update(
        OffendedUpdateRequest $request,
        Offended $offender
    ): OffendedResource {
        $this->authorize('update', $offender);

        $validated = $request->validated();
        $offender->update($validated);

        return new OffendedResource($offender);
    }

    public function destroy(Request $request, Offended $offender): Response
    {
        $this->authorize('delete', $offender);

        $offender->delete();

        return response()->noContent();
    }
}
