<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OutletRequest;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::latest()->paginate(10);
      
        return view('admin.outlets.index', compact('outlets'));
    }

    public function create()
    {
        return view('admin.outlets.create');
    }

    public function store(OutletRequest $request)
    {
        Outlet::create($request->validated());
        return redirect()->route('admin.outlets.index')
                         ->with('success', 'Outlet created successfully');
    }

    public function show(Outlet $outlet)
    {
        return view('admin.outlets.show', compact('outlet'));
    }

    public function edit(Outlet $outlet)
    {
        return view('admin.outlets.edit', compact('outlet'));
    }

    public function update(OutletRequest $request, Outlet $outlet)
    {
        $outlet->update($request->validated());
        return redirect()->route('admin.outlets.index')
                         ->with('success', 'Outlet updated successfully');
    }

    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        return redirect()->route('admin.outlets.index')
                         ->with('success', 'Outlet deleted successfully');
    }
}
