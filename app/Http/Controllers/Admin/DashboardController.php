<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\Refill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $refillCount = Refill::active()->count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentProducts = Product::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'refillCount',
            'unreadMessages',
            'recentProducts',
            'recentMessages',
        ));
    }
}
