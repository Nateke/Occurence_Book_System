<?php

namespace App\Http\Controllers\Api;

use App\Models\Subcounty;
use Illuminate\Http\Request;
use App\Http\Resources\WardResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\WardCollection;

class SubcountyWardsController extends Controller
{
    public function index(
        Request $request,
        Subcounty $subcounty
    ): WardCollection {
        $this->authorize('view', $subcounty);

        $search = $request->get('search', '');
        $wards = $subcounty
            ->wards()
            ->search($search)
            ->latest()
            ->get();

        return new WardCollection($wards);
    }
    public function store(Request $request, Subcounty $subcounty): WardResource
    {
        $this->authorize('create', Ward::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $ward = $subcounty->wards()->create($validated);

        return new WardResource($ward);
    }
}
