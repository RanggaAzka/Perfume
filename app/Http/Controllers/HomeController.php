<?php

namespace App\Http\Controllers;

use App\Models\FragranceNote;
use App\Models\Product;
use App\Models\Refill;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::active()->ordered()->with('fragranceNotes')->take(4)->get();
        $signatureNotes = FragranceNote::withCount('products')->orderByDesc('products_count')->take(6)->get();
        $refillPreview = Refill::active()->ordered()->take(8)->get();

        return view('home', compact('featuredProducts', 'signatureNotes', 'refillPreview'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function story(): View
    {
        return view('pages.story');
    }

    public function ingredients(): View
    {
        $notes = FragranceNote::withCount('products')->with('products')->orderBy('name')->get();

        $grouped = $notes
            ->groupBy(function (FragranceNote $note) {
                // A note's "primary" position is whichever position (top/heart/base)
                // it plays most often across the products that use it.
                if ($note->products->isEmpty()) {
                    return 'unassigned';
                }

                return $note->products
                    ->groupBy(fn ($product) => $product->pivot->position)
                    ->sortByDesc(fn ($group) => $group->count())
                    ->keys()
                    ->first();
            })
            ->only(['top', 'heart', 'base']);

        return view('pages.ingredients', compact('notes', 'grouped'));
    }
}
