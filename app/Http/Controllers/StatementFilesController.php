<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Statement;
use Illuminate\Http\Request;
use App\Models\StatementFiles;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StatementFilesStoreRequest;
use App\Http\Requests\StatementFilesUpdateRequest;

class StatementFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StatementFiles::class);

        $search = $request->get('search', '');

        $allStatementFiles = StatementFiles::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_statement_files.index',
            compact('allStatementFiles', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StatementFiles::class);

        $statements = Statement::pluck('id', 'id');

        return view('app.all_statement_files.create', compact('statements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatementFilesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StatementFiles::class);

        $validated = $request->validated();

        $statementFiles = StatementFiles::create($validated);

        return redirect()
            ->route('all-statement-files.edit', $statementFiles)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StatementFiles $statementFiles): View
    {
        $this->authorize('view', $statementFiles);

        return view('app.all_statement_files.show', compact('statementFiles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StatementFiles $statementFiles): View
    {
        $this->authorize('update', $statementFiles);

        $statements = Statement::pluck('id', 'id');

        return view(
            'app.all_statement_files.edit',
            compact('statementFiles', 'statements')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StatementFilesUpdateRequest $request,
        StatementFiles $statementFiles
    ): RedirectResponse {
        $this->authorize('update', $statementFiles);

        $validated = $request->validated();

        $statementFiles->update($validated);

        return redirect()
            ->route('all-statement-files.edit', $statementFiles)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StatementFiles $statementFiles
    ): RedirectResponse {
        $this->authorize('delete', $statementFiles);

        $statementFiles->delete();

        return redirect()
            ->route('all-statement-files.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
