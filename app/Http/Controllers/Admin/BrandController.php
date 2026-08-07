<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->latest()->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand_code' => 'required|unique:brands,brand_code',
        ]);

        Brand::create([
            'name' => $request->name,
            'brand_code' => $request->brand_code,
            'status' => 1,
        ]);

        return redirect()->route('brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand_code' => 'required|max:10|unique:brands,brand_code,'.$brand->id,
        ]);

        $brand->update([
            'name' => $request->name,
            'brand_code' => $request->brand_code,
            'status' => $request->status ?? 0,
        ]);

        return redirect()->route('brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->update([
            'status' => 0,
        ]);

        return redirect()->route('brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
