<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with(['createdBy', 'updatedBy'])
            ->latest()
            ->paginate(10);

        return view('admin.product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'status' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_ads' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        $validatedData['created_by'] = Auth::id();

        ProductCategory::create($validatedData);

        return redirect()->route('product_categories.index')
            ->with('success', 'Product category created successfully.');
    }

    public function edit(ProductCategory $productCategory)
    {
        $categories = ProductCategory::query()->latest()->get();

        return view('admin.product_categories.edit', compact('productCategory', 'categories'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $productCategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_ads' => $request->meta_ads,
            'meta_keyword' => $request->meta_keyword,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('product_categories.index')
            ->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->update([
            'status' => 0,
        ]);

        return redirect()->route('product_categories.index')
            ->with('success', 'Product category deactivated successfully.');
    }
}
