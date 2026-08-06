<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::query()->latest()->get();

        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'branch_code' => 'required|max:10|unique:branches,branch_code',
        ]);

        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'branch_code' => $request->branch_code,
            'status' => 1,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch created successfully.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'branch_code' => 'required|max:10|unique:branches,branch_code,'.$branch->id,
        ]);

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'branch_code' => $request->branch_code,
            'status' => $request->status ?? 0,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        $branch->update([
            'status' => 0,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
