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
        $refillPreview = Refill::active()->ordered()->take(12)->get();

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
}
