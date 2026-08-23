<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRefillRequest;
use App\Http\Requests\UpdateRefillRequest;
use App\Models\Refill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RefillController extends Controller
{
    public function index(Request $request): View
    {
        $refills = Refill::query()
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%' . $request->string('search') . '%'))
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('is_active', $request->string('status') === 'active');
            })
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('admin.refills.index', compact('refills'));
    }

    public function create(): View
    {
        return view('admin.refills.create');
    }

    public function store(StoreRefillRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        Refill::create($data);

        return redirect()->route('admin.refills.index')->with('status', 'Refill fragrance added.');
    }

    public function edit(Refill $refill): View
    {
        return view('admin.refills.edit', compact('refill'));
    }

    public function update(UpdateRefillRequest $request, Refill $refill): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $refill->update($data);

        return redirect()->route('admin.refills.index')->with('status', 'Refill fragrance updated.');
    }

    public function destroy(Refill $refill): RedirectResponse
    {
        $refill->delete();

        return redirect()->route('admin.refills.index')->with('status', 'Refill fragrance deleted.');
    }
}
