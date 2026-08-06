<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('branch')->get();

        return view('admin.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        $branches = Branch::all();

        return view('admin.warehouses.create', compact('branches'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'warehouse_code' => 'required|string|max:255|unique:warehouses,warehouse_code',
            'warehouse_name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1000',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'capacity' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Warehouse::create($validated);

        return redirect()->route('warehouses.create')
            ->with('success', 'Warehouse created successfully.');
    }

    public function edit(Warehouse $warehouse)
    {
        $branches = Branch::all();

        return view('admin.warehouses.edit', compact('warehouse', 'branches'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'warehouse_code' => 'required|string|max:255|unique:warehouses,warehouse_code,'.$warehouse->id,
            'warehouse_name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1000',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:20',
            'capacity' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);
        $validated['updated_by'] = Auth::id();

        $warehouse->update($validated);

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse)
    {
         $warehouse->update([
            'status' => 0,
        ]);

        return redirect()->route('warehouses.index')
            ->with('success', 'Warehouse deleted successfully.');
    }
}
