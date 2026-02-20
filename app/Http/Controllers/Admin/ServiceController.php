<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Services/Index', [
            'services' => Service::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Services/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:ERP,POS,Accounting,Custom,IT',
            'description' => 'nullable|string',
            'base_price'  => 'nullable|numeric|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return Inertia::render('Admin/Services/Edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:ERP,POS,Accounting,Custom,IT',
            'description' => 'nullable|string',
            'base_price'  => 'nullable|numeric|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}