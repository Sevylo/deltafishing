<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PesertaController;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/gallery', function () {
    return Inertia::render('Gallery');
})->name('gallery');

// Bayar routes
Route::get('/bayar', [BayarController::class, 'index'])->name('bayar.index');
Route::get('/bayar/create', [BayarController::class, 'create'])->name('bayar.create');
Route::post('/bayar', [BayarController::class, 'store'])->name('bayar.store');
Route::get('/bayar/{id}/edit', [BayarController::class, 'edit'])->name('bayar.edit');
Route::put('/bayar/{id}', [BayarController::class, 'update'])->name('bayar.update');

Route::view('/about', 'about.about')->name('about');
Route::view('/sewa', 'bayar.sewa')->name('sewa');

// Event routes
Route::get('/event', [EventController::class, 'index'])->name('nopal.event.index');
Route::get('/event/peserta', [EventController::class, 'list'])->name('nopal.event.peserta');

// Menu and Pesan (order) routes
Route::get('/menu', function () {
    return view('menu');
})->name('menu');
Route::get('/pesan', [OrderController::class, 'pesan'])->name('pesan');

/*
|--------------------------------------------------------------------------
| 2. RUTE UNTUK USER YANG LOGIN (Admin & User Biasa)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute pendaftaran event sekarang memerlukan login
    Route::get('/event/daftar', [EventController::class, 'create'])->name('nopal.event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('nopal.event.store');

    // Rute lain yang butuh login
    Route::get('/history', [BayarController::class, 'history'])->name('bayar.history');
    Route::get('/booking-history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.list');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
});

/*
|--------------------------------------------------------------------------
| 3. RUTE KHUSUS ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/pesertas', [PesertaController::class, 'index'])->name('pesertas.index');
    Route::get('/pesertas/{peserta}/edit', [PesertaController::class, 'edit'])->name('pesertas.edit');
    Route::put('/pesertas/{peserta}', [PesertaController::class, 'update'])->name('pesertas.update');
    Route::delete('/pesertas/{peserta}', [PesertaController::class, 'destroy'])->name('pesertas.destroy');
    Route::delete('/bayar/{id}', [BayarController::class, 'destroy'])->name('bayar.destroy');
    Route::get('/chart', [BayarController::class, 'chart'])->name('bayar.chart');

    // Booking admin routes
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::get('/admin/bookings/{booking}/edit', [BookingController::class, 'adminEdit'])->name('admin.bookings.edit');
    Route::get('/admin/booking-items/{bookingItem}/edit', [BookingController::class, 'adminEditItem'])->name('admin.booking_items.edit');
    Route::delete('/admin/bookings/{booking}', [BookingController::class, 'adminDestroy'])->name('admin.bookings.destroy');
    Route::put('/admin/bookings/{booking}', [BookingController::class, 'adminUpdate'])->name('admin.bookings.update');
    Route::put('/admin/booking-items/{bookingItem}', [BookingController::class, 'adminUpdateItem'])->name('admin.booking_items.update');
    Route::delete('/admin/booking-items/{bookingItem}', [BookingController::class, 'adminDestroyItem'])->name('admin.booking_items.destroy');
});

// Booking route
Route::get('/booking', function () {
    return view('nopal.booking');
})->name('booking');


// File-file route bawaan
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';