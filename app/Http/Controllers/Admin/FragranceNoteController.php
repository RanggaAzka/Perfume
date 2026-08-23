<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFragranceNoteRequest;
use App\Http\Requests\UpdateFragranceNoteRequest;
use App\Models\FragranceNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FragranceNoteController extends Controller
{
    public function index(): View
    {
        $notes = FragranceNote::withCount('products')->orderBy('name')->paginate(15);

        return view('admin.fragrance-notes.index', compact('notes'));
    }

    public function create(): View
    {
        return view('admin.fragrance-notes.create');
    }

    public function store(StoreFragranceNoteRequest $request): RedirectResponse
    {
        FragranceNote::create($request->validated());

        return redirect()->route('admin.fragrance-notes.index')->with('status', 'Fragrance note added.');
    }

    // Note: the route wildcard for this resource is {fragrance_note} (Laravel
    // derives this from the "fragrance-notes" URI segment), so the parameter
    // name here must match exactly for implicit route-model binding to work.
    public function edit(FragranceNote $fragrance_note): View
    {
        return view('admin.fragrance-notes.edit', ['fragranceNote' => $fragrance_note]);
    }

    public function update(UpdateFragranceNoteRequest $request, FragranceNote $fragrance_note): RedirectResponse
    {
        $fragrance_note->update($request->validated());

        return redirect()->route('admin.fragrance-notes.index')->with('status', 'Fragrance note updated.');
    }

    public function destroy(FragranceNote $fragrance_note): RedirectResponse
    {
        $fragrance_note->delete();

        return redirect()->route('admin.fragrance-notes.index')->with('status', 'Fragrance note deleted.');
    }
}
