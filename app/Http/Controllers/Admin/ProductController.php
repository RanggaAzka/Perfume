<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\FragranceNote;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%' . $request->string('search') . '%'))
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('is_active', $request->string('status') === 'active');
            })
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $fragranceNotes = FragranceNote::orderBy('name')->get();

        return view('admin.products.create', compact('fragranceNotes'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['fragrance_notes'], $data['fragrance_note_positions']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = ($data['slug'] ?? '') ?: Product::uniqueSlug($data['name']);

        $product = Product::create($data);
        $product->fragranceNotes()->sync($this->noteSyncData($request));

        return redirect()->route('admin.products.index')->with('status', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $fragranceNotes = FragranceNote::orderBy('name')->get();
        $product->load('fragranceNotes');

        return view('admin.products.edit', compact('product', 'fragranceNotes'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        unset($data['fragrance_notes'], $data['fragrance_note_positions']);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = ($data['slug'] ?? '') ?: Product::uniqueSlug($data['name'], $product->id);

        $product->update($data);
        $product->fragranceNotes()->sync($this->noteSyncData($request));

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product deleted.');
    }

    /**
     * Build the sync() payload pairing each selected fragrance note with its
     * chosen olfactive position (top/heart/base), defaulting to 'heart'.
     */
    private function noteSyncData(Request $request): array
    {
        $noteIds = $request->input('fragrance_notes', []);
        $positions = $request->input('fragrance_note_positions', []);

        return collect($noteIds)->mapWithKeys(fn ($id) => [
            $id => ['position' => $positions[$id] ?? 'heart'],
        ])->all();
    }
}
