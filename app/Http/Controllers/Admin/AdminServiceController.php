<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\AdminActivity;
use Illuminate\Support\Facades\Schema;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at','desc')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'available' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // If DB doesn't have sort_order column, remove it from data to avoid SQL errors
        if (!Schema::hasColumn('services', 'sort_order') && array_key_exists('sort_order', $data)) {
            unset($data['sort_order']);
        }

        $service = Service::create(array_merge($data, ['available' => $data['available'] ?? true]));
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'create_service', 'details' => 'Created service '.$service->id, 'ip' => request()->ip()]);
        return redirect()->route('admin.services.index')->with('status','Service created');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'available' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Avoid trying to update sort_order if column is missing
        if (!Schema::hasColumn('services', 'sort_order') && array_key_exists('sort_order', $data)) {
            unset($data['sort_order']);
        }

        $service->update(array_merge($data, ['available' => $data['available'] ?? true]));
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'update_service', 'details' => 'Updated service '.$service->id, 'ip' => request()->ip()]);
        return redirect()->route('admin.services.index')->with('status','Service updated');
    }

    public function destroy(Service $service)
    {
        $id = $service->id;
        $service->delete();
        AdminActivity::create(['user_id' => auth()->id(), 'action' => 'delete_service', 'details' => 'Deleted service '.$id, 'ip' => request()->ip()]);
        return redirect()->route('admin.services.index')->with('status','Service deleted');
    }
}
