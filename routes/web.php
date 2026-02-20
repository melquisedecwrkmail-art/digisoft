<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Workspace;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\WorkspaceController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceRequestController as AdminServiceRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\BookingController as ClientBookingController;
use App\Http\Controllers\Client\ServiceRequestController as ClientServiceRequestController;

Route::get('/', fn() => Inertia::render('Marketing/Home'))->name('home');

Route::get('/workspaces', function (Request $request) {
    $query = Workspace::with('location')->where('status', 'available');

    if ($request->type && $request->type !== 'all') {
        $query->where('type', $request->type);
    }

    if ($request->city) {
        $query->whereHas('location', fn($q) => $q->where('city', 'like', '%' . $request->city . '%'));
    }

    return Inertia::render('Marketing/Workspaces', [
        'workspaces' => $query->paginate(9),
        'filters'    => $request->only('type', 'city'),
    ]);
})->name('workspaces');

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboard::class, 'index'])->name('dashboard');
        Route::get('/bookings', [ClientBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/create', [ClientBookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [ClientBookingController::class, 'store'])->name('bookings.store');
        Route::post('/bookings/{booking}/cancel', [ClientBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::get('/service-requests', [ClientServiceRequestController::class, 'index'])->name('service-requests.index');
        Route::get('/service-requests/create', [ClientServiceRequestController::class, 'create'])->name('service-requests.create');
        Route::post('/service-requests', [ClientServiceRequestController::class, 'store'])->name('service-requests.store');
    });

    Route::middleware('role:admin,staff')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::resource('locations', LocationController::class)->except(['show']);
        Route::resource('workspaces', WorkspaceController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
        Route::get('/service-requests', [AdminServiceRequestController::class, 'index'])->name('service-requests.index');
        Route::post('/service-requests/{serviceRequest}/approve', [AdminServiceRequestController::class, 'approve'])->name('service-requests.approve');
        Route::post('/service-requests/{serviceRequest}/reject', [AdminServiceRequestController::class, 'reject'])->name('service-requests.reject');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::match(['PUT', 'POST'], '/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::post('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    });

});

// Emergency logout
Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('web')->name('force.logout');

require __DIR__.'/auth.php';