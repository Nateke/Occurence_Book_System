<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\Statement;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StatementStoreRequest;
use App\Http\Requests\StatementUpdateRequest;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Statement::class);

        $search = $request->get('search', '');

        $statements = Statement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.statements.index', compact('statements', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Statement::class);

        $officers = Officer::pluck('officer_name', 'id');

        return view('app.statements.create', compact('officers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatementStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Statement::class);

        $validated = $request->validated();

        $statement = Statement::create($validated);

        return redirect()
            ->route('statements.edit', $statement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Statement $statement): View
    {
        $this->authorize('view', $statement);

        return view('app.statements.show', compact('statement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Statement $statement): View
    {
        $this->authorize('update', $statement);

        $officers = Officer::pluck('officer_name', 'id');

        return view('app.statements.edit', compact('statement', 'officers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StatementUpdateRequest $request,
        Statement $statement
    ): RedirectResponse {
        $this->authorize('update', $statement);

        $validated = $request->validated();

        $statement->update($validated);

        return redirect()
            ->route('statements.edit', $statement)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Statement $statement
    ): RedirectResponse {
        $this->authorize('delete', $statement);

        $statement->delete();

        return redirect()
            ->route('statements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
