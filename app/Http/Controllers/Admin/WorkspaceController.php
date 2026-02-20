<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkspaceController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Workspaces/Index', [
            'workspaces' => Workspace::with('location')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Workspaces/Create', [
            'locations' => Location::where('status', 'active')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:private,desk,meeting,virtual',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
            'status'      => 'required|in:available,unavailable',
        ]);
        Workspace::create($request->all());
        return redirect()->route('admin.workspaces.index')->with('success', 'Workspace created.');
    }

    public function edit(Workspace $workspace)
    {
        return Inertia::render('Admin/Workspaces/Edit', [
            'workspace' => $workspace->load('location'),
            'locations' => Location::where('status', 'active')->get(),
        ]);
    }

    public function update(Request $request, Workspace $workspace)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:private,desk,meeting,virtual',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
            'status'      => 'required|in:available,unavailable',
        ]);
        $workspace->update($request->all());
        return redirect()->route('admin.workspaces.index')->with('success', 'Workspace updated.');
    }

    public function destroy(Workspace $workspace)
    {
        $workspace->delete();
        return redirect()->route('admin.workspaces.index')->with('success', 'Workspace deleted.');
    }
}
