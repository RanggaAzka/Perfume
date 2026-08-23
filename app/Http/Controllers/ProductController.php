<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::active()->ordered()->with('fragranceNotes')->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load('fragranceNotes');

        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->ordered()
            ->take(2)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
