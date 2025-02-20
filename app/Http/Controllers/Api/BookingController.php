<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Booking_Offence;
use App\Models\BookingOffended;
use App\Models\BookingOffender;
use App\Models\BookingWitness;
use App\Models\Officer;
use App\Models\Statement;
use App\Models\StatementFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingCollection;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request): BookingCollection
    {
        $this->authorize('view-any', Booking::class);
        $search = $request->get('search', '');
        $officer = Officer::findOrFail($request->user()->id);
        $bookings = Booking::where('officer_id', $officer->id)
            ->with('witnesses:id,first_name,middle_name,last_name','offender:id,first_name,middle_name,last_name','offended:id,first_name,middle_name,last_name','officer:id,name','statement:id,statement_text')
            ->search($search)
            ->latest()
            ->get();
        return new BookingCollection($bookings);
    }
    public function store(BookingStoreRequest $request): BookingResource
    {
        $this->authorize('create', Booking::class);
        $validated = $request->validated();
        $officer=Officer::where('user_id', Auth::user()->id)->first();
        $validated['officer_id'] = $officer->id;
        $validated['booking_date'] = Carbon::now()->toDateString();
        $validated['booking_time'] = Carbon::now()->toTimeString();
        $validated['station_id'] = $officer->station_id;
        try {
            DB::beginTransaction();

        $booking = Booking::create($validated);

        if ($request->has('offended')) {
            foreach ($request->input('offended') as $offendedData) {
                $fileUrl = $offendedData['signature']->store('signatures');
                BookingOffended::create([
                    'booking_id' => $booking->id,
                    'offended_id' => $offendedData['id'],
                    'signature_path' => $fileUrl,
                ]);
            }
        }

        // Create associated records in booking_offenders table
        if ($request->has('offenders')) {
            foreach ($request->input('offenders') as $offenderData) {
                $fileUrl = $offenderData['signature']->store('signatures');
                BookingOffender::create([
                    'booking_id' => $booking->id,
                    'offender_id' => $offenderData['id'],
                    'signature_path' => $fileUrl,
                ]);
            }
        }

        // Create associated records in booking_witnesses table
        if ($request->has('witnesses')) {
            foreach ($request->input('witnesses') as $witnessData) {
                $fileUrl = $witnessData['signature']->store('signatures');
                BookingWitness::create([
                    'booking_id' => $booking->id,
                    'witness_id' => $witnessData['id'],
                    'signature_path' => $fileUrl,
                ]);
            }
        }

        // Create associated records in booking__offences table
        if ($request->has('offense_ids')) {
            foreach ($request->input('offense_ids') as $offenseId) {
                Booking_Offence::create([
                    'booking_id' => $booking->id,
                    'offense_id' => $offenseId,
                ]);
            }
        }

        // Create associated records in statements table
        $statement = Statement::create([
            'statement_text' => $request->input('statement'),
            'recorded_by' => $officer->id,
            'recording_date' => now(),
            'booking_id' => $booking->id,
            'evidence_collected' => $request->input('evidence_collected'),
        ]);

        // Create associated records in statement_files table
        if ($request->hasFile('statement_files')) {
            foreach ($request->file('statement_files') as $file) {
                $fileUrl = $file->store('statement_files');
                StatementFiles::create([
                    'file_url' => $fileUrl,
                    'statement_id' => $statement->id,
                ]);
            }
        }
            DB::commit();
        return new BookingResource($booking);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return new BookingResource(["error"=>"could not complete the operation", "error_track"=>$e]);
        }
    }
    public function show(Request $request, $booking): BookingResource
    {
        $this->authorize('view',$booking);
        $officer = Officer::findOrFail($request->user()->id);
        $booking = Booking::where('id',$booking)->where('officer_id', $officer->id)->first();
        return new BookingResource($booking);
    }
    public function update(
        BookingUpdateRequest $request,
        Booking $booking
    ): BookingResource {
        $this->authorize('update', $booking);

        $validated = $request->validated();

        $booking->update($validated);

        return new BookingResource($booking);
    }

    public function destroy(Request $request, Booking $booking): Response
    {
        $this->authorize('delete', $booking);

        $booking->delete();

        return response()->noContent();
    }
}
