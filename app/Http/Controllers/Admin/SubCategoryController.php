<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Show the form for creating a new sub category.
     */
    public function create()
    {
        $categories = ProductCategory::all();

        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $subcategory = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        SubCategory::create($subcategory);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category created successfully.');
    }

    public function index()
    {
        $subcategories = SubCategory::with('category')->get();

        return view('admin.sub_categories.index', compact('subcategories'));
    }

    public function edit(SubCategory $sub_category)
    {
        $categories = ProductCategory::all();

        return view('admin.sub_categories.edit', compact('sub_category', 'categories'));
    }

    public function update(Request $request, SubCategory $sub_category)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $sub_category->update($validatedData);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(SubCategory $sub_category)
    {
        $sub_category->update([
            'status' => 0,
        ]);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category deleted successfully.');
    }
}
