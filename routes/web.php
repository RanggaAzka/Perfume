<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FragranceNoteController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\RefillController as AdminRefillController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RefillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public website
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/story', [HomeController::class, 'story'])->name('story');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/refills', [RefillController::class, 'index'])->name('refills.index');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Cart (guest, session based — slide-over drawer, no separate page)
|--------------------------------------------------------------------------
*/
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('cart/{key}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/{key}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

/*
|--------------------------------------------------------------------------
| Authentication (login only — this brand site has no public registration)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', AdminProductController::class)->except('show');
    Route::resource('refills', AdminRefillController::class)->except('show');
    Route::resource('fragrance-notes', FragranceNoteController::class)->except('show');

    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{message}/reply', [ContactMessageController::class, 'reply'])->name('messages.reply');
    Route::patch('messages/{message}/unread', [ContactMessageController::class, 'markUnread'])->name('messages.unread');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/test-whatsapp', [SettingController::class, 'testWhatsApp'])->name('settings.test-whatsapp');
});
