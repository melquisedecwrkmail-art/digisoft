<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\WorkspaceController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\BookingController as ClientBookingController;

// ==========================================
// PUBLIC / MARKETING ROUTES
// ==========================================
Route::get('/', fn() => Inertia::render('Marketing/Home'))->name('home');
Route::get('/workspaces', fn() => Inertia::render('Marketing/Workspaces'))->name('workspaces');
Route::get('/services', fn() => Inertia::render('Marketing/Services'))->name('services');
Route::get('/about', fn() => Inertia::render('Marketing/About'))->name('about');
Route::get('/contact', fn() => Inertia::render('Marketing/Contact'))->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string|min:10',
    ]);
    return redirect()->back();
})->name('contact.submit');

// ==========================================
// AUTHENTICATED ROUTES
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // ------------------------------------------
    // CLIENT ROUTES
    // ------------------------------------------
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
        Route::get('/bookings', [ClientBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/create', [ClientBookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [ClientBookingController::class, 'store'])->name('bookings.store');
        Route::post('/bookings/{booking}/cancel', [ClientBookingController::class, 'cancel'])->name('bookings.cancel');
    });

    // ------------------------------------------
    // ADMIN ROUTES
    // ------------------------------------------
    Route::middleware('role:admin,staff')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Locations
        Route::resource('locations', LocationController::class)->except(['show']);

        // Workspaces
        Route::resource('workspaces', WorkspaceController::class)->except(['show']);

        // Bookings
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

        // Services
        Route::resource('services', ServiceController::class)->except(['show']);

        // Users (placeholder)
        Route::get('/users', fn() => Inertia::render('Admin/Users/Index'))->name('users.index');
    });

});

require __DIR__.'/auth.php';