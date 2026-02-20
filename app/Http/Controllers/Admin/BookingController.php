<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Bookings/Index', [
            'bookings' => Booking::with(['user', 'workspace.location'])->latest()->paginate(15),
        ]);
    }

    public function approve(Booking $booking)
    {
        $booking->update(['booking_status' => 'approved']);
        return back()->with('success', 'Booking approved.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['booking_status' => 'rejected']);
        return back()->with('success', 'Booking rejected.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Booking deleted.');
    }
}
