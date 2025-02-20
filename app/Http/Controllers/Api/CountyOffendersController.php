<?php

namespace App\Http\Controllers\Api;

use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OffenderResource;
use App\Http\Resources\OffenderCollection;

class CountyOffendersController extends Controller
{
    public function index(Request $request, County $county): OffenderCollection
    {
        $this->authorize('view', $county);

        $search = $request->get('search', '');

        $offenders = $county
            ->offenders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OffenderCollection($offenders);
    }

}
