<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return view('admin.branches.index');
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->save();

        return redirect()->route('branches.index')
            ->with('success', 'Branch created successfully');
    }
}
