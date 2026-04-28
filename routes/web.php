<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('home');

Route::get('/dashboard', function () {
    $recentBookings = \App\Models\Booking::latest()->take(5)->get();
    $recentExpenses = \App\Models\Expense::latest('id')->take(5)->get();
    $totalExpenses = \App\Models\Expense::sum('Total');
    $bookingCount = \App\Models\Booking::count();
    
    return view('dashboard', compact('recentBookings', 'recentExpenses', 'totalExpenses', 'bookingCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('addresses', AddressController::class);
    Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
    Route::resource('products', ProductController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
