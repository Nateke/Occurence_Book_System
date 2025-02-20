<?php

namespace App\Http\Controllers\Api;

use App\Models\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffenderResource;
use App\Http\Resources\OffenderCollection;

class WardOffendersController extends Controller
{
    public function index(Request $request, Ward $ward): OffenderCollection
    {
        $this->authorize('view', $ward);

        $search = $request->get('search', '');

        $offenders = $ward
            ->offenders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OffenderCollection($offenders);
    }

    public function store(Request $request, Ward $ward): OffenderResource
    {
        $this->authorize('create', Offender::class);

        $validated = $request->validate([
            'booking_id' => ['required', 'max:255'],
            'id_scan' => ['nullable', 'max:255'],
            'underage_flag' => ['required', 'boolean'],
            'phone_number' => ['nullable', 'max:255', 'string'],
            'country_id' => ['required', 'max:255'],
            'county_id' => ['required', 'exists:counties,id'],
            'subcounty_id' => ['required', 'exists:subcounties,id'],
            'location' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'occupation' => ['required', 'max:255', 'string'],
        ]);

        $offender = $ward->offenders()->create($validated);

        return new OffenderResource($offender);
    }
}
