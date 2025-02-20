<?php

namespace App\Http\Controllers\Api;

use App\Models\OffenseCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffenseResource;
use App\Http\Resources\OffenseCollection;

class OffenseCaseOffensesController extends Controller
{
    public function index(
        Request $request,
        OffenseCase $offenseCase
    ): OffenseCollection {
        $this->authorize('view', $offenseCase);

        $search = $request->get('search', '');

        $offenses = $offenseCase
            ->offenses()
            ->search($search)
            ->latest()
            ->paginate();

        return new OffenseCollection($offenses);
    }

    public function store(
        Request $request,
        OffenseCase $offenseCase
    ): OffenseResource {
        $this->authorize('create', Offense::class);

        $validated = $request->validate([
            'offence_name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'fine_amount' => ['required', 'numeric'],
            'imprisonment_duration' => ['required', 'max:255', 'string'],
        ]);

        $offense = $offenseCase->offenses()->create($validated);

        return new OffenseResource($offense);
    }
}
