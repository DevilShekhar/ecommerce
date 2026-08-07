<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->latest()->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $categories = ProductCategory::query()->where('status', 1)->get();

        return view('admin.brands.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_code' => 'required|string|max:255|unique:brands,brand_code',
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'required|exists:sub_category,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_ads' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        Brand::create([
            'name' => $request->name,
            'brand_code' => $request->brand_code,
            'status' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'meta_title' => $request->meta_title,
            'meta_ads' => $request->meta_ads,
            'meta_keyword' => $request->meta_keyword,
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        $categories = ProductCategory::query()->where('status', 1)->get();

        return view('admin.brands.edit', compact('brand', 'categories'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand_code' => 'required|string|max:255|unique:brands,brand_code,'.$brand->id,
            'category_id' => 'nullable|exists:product_categories,id',
            'sub_category_id' => 'nullable|exists:sub_category,id',
            'status' => 'required|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_ads' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        $brand->update([
            'name' => $request->name,
            'brand_code' => $request->brand_code,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'meta_title' => $request->meta_title,
            'meta_ads' => $request->meta_ads,
            'meta_keyword' => $request->meta_keyword,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function show($id)
    {
        $brand = Brand::with(['createdBy', 'updatedBy'])->findOrFail($id);

        return view('admin.brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        $brand->update([
            'status' => 0,
        ]);

        return redirect()->route('brands.index')
            ->with('success', 'Brand deleted successfully.');
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::query()->where('category_id', $categoryId)->get();

        return response()->json($subCategories);
    }
}
