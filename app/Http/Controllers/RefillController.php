<?php

namespace App\Http\Controllers;

use App\Models\Refill;
use Illuminate\View\View;

class RefillController extends Controller
{
    public function index(): View
    {
        $refills = Refill::active()->ordered()->get();

        $grouped = $refills
            ->groupBy(fn (Refill $refill) => strtoupper(substr($refill->name, 0, 1)))
            ->sortKeys();

        return view('refills.index', compact('grouped'));
    }
}
