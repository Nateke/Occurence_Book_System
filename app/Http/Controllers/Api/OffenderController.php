<?php

namespace App\Http\Controllers\Api;

use App\Models\Offender;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffenderResource;
use App\Http\Resources\OffenderCollection;
use App\Http\Requests\OffenderStoreRequest;
use App\Http\Requests\OffenderUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OffenderController extends Controller
{
    public function index(Request $request): OffenderCollection
    {
        $this->authorize('view-any', Offender::class);

        $search = $request->get('search', '');

        $offenders = Offender::where('added_by',Auth::user()->id)->search($search)
            ->latest()
            ->paginate();

        return new OffenderCollection($offenders);
    }
    public function all(Request $request): OffenderCollection
    {
        $this->authorize('view-any', Offender::class);

        $search = $request->get('search', '');

        $offenders = Offender::search($search)
            ->latest()
            ->paginate();

        return new OffenderCollection($offenders);
    }

    public function store(OffenderStoreRequest $request): OffenderResource
    {
        $this->authorize('create', Offender::class);
        $validated = $request->validated();
        $validated['added_by'] = Auth::id();

        try {
            if ($request->hasFile('photo1')) {
                $validated['photo1_path'] = $request->file('photo1')->store('offender_photos');
            }

            if ($request->hasFile('photo2')) {
                $validated['photo2_path'] = $request->file('photo2')->store('offender_photos');
            }

            if ($request->hasFile('photo3')) {
                $validated['photo3_path'] = $request->file('photo3')->store('offender_photos');
            }
            $offender = Offender::create($validated);
            return new OffenderResource($offender);
        }
        catch (\Exception $e) {
            return new OffenderResource(['error' => 'Failed to create offender.', 'details'=>$e], 500);
        }
    }

    public function show(Request $request, Offender $offender): OffenderResource
    {
        $this->authorize('view', $offender);

        return new OffenderResource($offender);
    }

    public function update(
        OffenderUpdateRequest $request,
        Offender $offender
    ): OffenderResource {
        $this->authorize('update', $offender);

        $validated = $request->validated();
        if ($request->hasFile('photo1')) {
            $validated['photo1_path'] = $request->file('photo1')->store('offender_photos');
        }

        if ($request->hasFile('photo2')) {
            $validated['photo2_path'] = $request->file('photo2')->store('offender_photos');
        }

        if ($request->hasFile('photo3')) {
            $validated['photo3_path'] = $request->file('photo3')->store('offender_photos');
        }
        $offender->update($validated);

        return new OffenderResource($offender);
    }

    public function destroy(Request $request, Offender $offender): Response
    {
        $this->authorize('delete', $offender);

        $offender->delete();

        return response()->noContent();
    }
}
