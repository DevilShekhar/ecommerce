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
            'category_id'      => 'required|exists:product_categories,id',
            'name'             => 'required|string|max:255',
            'status'           => 'nullable|boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
        ]);

        // Attach logged-in User ID
        $subcategory['created_by'] = auth()->id();
        $subcategory['updated_by'] = auth()->id();

        SubCategory::create($subcategory);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category created successfully.');
    }

    public function index()
    {
        $subcategories = SubCategory::with('category', 'creator', 'updater')->latest()->get();

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
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $sub_category->update($validatedData);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(SubCategory $sub_category)
    {
        $sub_category->update([
            'status' => 0,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('sub_categories.index')
            ->with('success', 'Sub Category deleted successfully.');
    }
}
