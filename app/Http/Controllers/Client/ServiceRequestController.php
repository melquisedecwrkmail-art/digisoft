<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceRequestController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Client/Services/Index', [
            'requests' => ServiceRequest::with('service')
                ->where('user_id', $request->user()->id)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Client/Services/Create', [
            'services' => Service::where('status', 'active')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'description' => 'nullable|string|max:1000',
        ]);

        ServiceRequest::create([
            'user_id'     => $request->user()->id,
            'service_id'  => $request->service_id,
            'description' => $request->description,
            'status'      => 'pending',
        ]);

        return redirect()->route('client.service-requests.index')
            ->with('success', 'Service request submitted!');
    }
}