<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        ProductCategory::create($validatedData);

        return redirect()->route('product_categories.index')
            ->with('success', 'Product category created successfully.');
    }

    public function edit(ProductCategory $productCategory)
    {
        $categories = ProductCategory::all();
        return view('admin.product_categories.edit', compact('productCategory', 'categories'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,'.$productCategory->id,
        ]);

        $productCategory->update($validatedData);

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
