<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceRequestController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ServiceRequests/Index', [
            'requests' => ServiceRequest::with(['user', 'service'])
                ->latest()
                ->paginate(15),
        ]);
    }

    public function approve(ServiceRequest $serviceRequest)
    {
        $serviceRequest->update(['status' => 'approved']);
        return back()->with('success', 'Request approved.');
    }

    public function reject(ServiceRequest $serviceRequest)
    {
        $serviceRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Request rejected.');
    }
}