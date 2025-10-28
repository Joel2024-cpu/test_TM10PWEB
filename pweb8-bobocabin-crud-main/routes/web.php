<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CabinController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\CabinDBHelperController;
use App\Http\Controllers\Admin\CabinQBController;
use App\Http\Controllers\Admin\CabinORMController;


Route::get('/', [CabinController::class, 'index']);
Route::get('/cabin/{id}', [CabinController::class, 'show']);
Route::get('/booking/{id}', [BookingController::class, 'create']);
Route::post('/booking', [BookingController::class, 'store']);


Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/orm');
    })->name('admin.dashboard');

    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings');
    Route::resource('dbhelper', CabinDBHelperController::class);
    Route::resource('qb', CabinQBController::class);
    Route::resource('orm', CabinORMController::class);
});
