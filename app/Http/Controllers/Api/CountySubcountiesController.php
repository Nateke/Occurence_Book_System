<?php

namespace App\Http\Controllers\Api;

use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubcountyResource;
use App\Http\Resources\SubcountyCollection;

class CountySubcountiesController extends Controller
{
    public function index(Request $request, County $county): SubcountyCollection
    {
        $this->authorize('view', $county);

        $search = $request->get('search', '');

        $subcounties = $county
            ->subcounties()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubcountyCollection($subcounties);
    }

    public function store(Request $request, County $county): SubcountyResource
    {
        $this->authorize('create', Subcounty::class);

        $validated = $request->validate([
            'subcounty_name' => ['required', 'max:255', 'string'],
        ]);

        $subcounty = $county->subcounties()->create($validated);

        return new SubcountyResource($subcounty);
    }
}
