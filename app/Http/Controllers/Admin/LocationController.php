<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Locations/Index', [
            'locations' => Location::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Locations/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'status'  => 'required|in:active,inactive',
        ]);
        Location::create($request->all());
        return redirect()->route('admin.locations.index')->with('success', 'Location created.');
    }

    public function edit(Location $location)
    {
        return Inertia::render('Admin/Locations/Edit', ['location' => $location]);
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'status'  => 'required|in:active,inactive',
        ]);
        $location->update($request->all());
        return redirect()->route('admin.locations.index')->with('success', 'Location updated.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted.');
    }
}
