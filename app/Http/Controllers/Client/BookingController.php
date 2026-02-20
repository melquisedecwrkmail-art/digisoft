<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Client/Bookings/Index', [
            'bookings' => Booking::with(['workspace.location'])
                ->where('user_id', $request->user()->id)
                ->latest()->paginate(10),
        ]);
    }

    public function create(Request $request)
    {
        $workspace = Workspace::with('location')->findOrFail($request->workspace_id);
        return Inertia::render('Client/Bookings/Create', ['workspace' => $workspace]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'start_date'   => 'required|date|after_or_equal:today',
            'end_date'     => 'required|date|after_or_equal:start_date',
        ]);

        $workspace = Workspace::findOrFail($request->workspace_id);

        $conflict = Booking::where('workspace_id', $request->workspace_id)
            ->whereNotIn('booking_status', ['rejected', 'cancelled'])
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('start_date', '<=', $request->start_date)
                        ->where('end_date', '>=', $request->end_date);
                  });
            })->exists();

        if ($conflict) {
            return back()->withErrors(['start_date' => 'This workspace is already booked for the selected dates.']);
        }

        $start = \Carbon\Carbon::parse($request->start_date);
        $end   = \Carbon\Carbon::parse($request->end_date);
        $days  = max(1, $start->diffInDays($end) + 1);
        $total = $days * $workspace->price;

        Booking::create([
            'user_id'        => $request->user()->id,
            'workspace_id'   => $request->workspace_id,
            'start_date'     => $request->start_date,
            'end_date'       => $request->end_date,
            'total_price'    => $total,
            'payment_status' => 'pending',
            'booking_status' => 'pending',
        ]);

        return redirect()->route('client.bookings.index')->with('success', 'Booking submitted!');
    }

    public function cancel(Booking $booking, Request $request)
    {
        if ($booking->user_id !== $request->user()->id) abort(403);
        $booking->update(['booking_status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled.');
    }
}
