<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PreferenceController;

// Public Routes
Route::get('/', [CabinController::class, 'index'])->name('home');
Route::get('/cabins/{id}', [CabinController::class, 'show'])->name('cabins.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ COOKIES Routes
Route::post('/preferences', [PreferenceController::class, 'setPreferences'])->name('preferences.set');
Route::post('/search/save', [PreferenceController::class, 'saveSearch'])->name('search.save');

// ✅ SESSION Routes (Bukan login)
Route::post('/wishlist/add', [BookingController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [BookingController::class, 'getWishlist'])->name('wishlist');

// Booking Routes
Route::get('/booking/{id}/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // ✅ DASHBOARD Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ AUTHORIZATION: Admin only
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings');
    Route::get('/admin/dashboard', function () {
        if (session('user_role') !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
