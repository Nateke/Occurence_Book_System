<?php

namespace App\Http\Controllers\Api;

use App\Models\Officer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;

class OfficerBookingsController extends Controller
{
    public function index(Request $request, Officer $officer): BookingCollection
    {
        $this->authorize('view', $officer);

        $search = $request->get('search', '');

        $bookings = $officer
            ->bookings()
            ->search($search)
            ->latest()
            ->paginate();

        return new BookingCollection($bookings);
    }

    public function store(Request $request, Officer $officer): BookingResource
    {
        $this->authorize('create', Booking::class);

        $validated = $request->validate([
            'booking_date' => ['required', 'date'],
            'booking_time' => ['required', 'date_format:H:i:s'],
            'location' => ['max:255', 'string'],
            'remarks' => ['required', 'max:255', 'string'],
            'evidence_collected' => ['max:255', 'string'],
            'offenseCase_id' => ['required', 'exists:signatures,id'],
        ]);

        $booking = $officer->bookings()->create($validated);

        return new BookingResource($booking);
    }
}
