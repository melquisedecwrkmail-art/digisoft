<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Client/Dashboard', [
            'bookings' => $request->user()->bookings()->with('workspace')->latest()->get(),
        ]);
    }
}
