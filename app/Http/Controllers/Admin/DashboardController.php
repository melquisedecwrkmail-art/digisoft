<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'total_users'      => User::count(),
                'total_bookings'   => Booking::count(),
                'pending_bookings' => Booking::where('booking_status', 'pending')->count(),
            ]
        ]);
    }
}
