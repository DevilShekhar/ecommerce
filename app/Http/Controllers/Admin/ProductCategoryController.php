<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Str;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_ads' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
        ]);
        $validatedData['slug'] = \Illuminate\Support\Str::slug($request->name);

        // Upload category image
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $validatedData['created_by'] = Auth::id();

        ProductCategory::create($validatedData);

        return redirect()
            ->route('product_categories.index')
            ->with('success', 'Product category created successfully.');
    }

    public function edit(ProductCategory $productCategory)
    {
        $categories = ProductCategory::query()->latest()->get();

        return view('admin.product_categories.edit', compact('productCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $productCategory = ProductCategory::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,'.$id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_ads' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        // Generate slug automatically from category name
        $slug = \Illuminate\Support\Str::slug($request->name);

        // Make sure slug is unique except current category
        $originalSlug = $slug;
        $counter = 1;

        while (
            ProductCategory::query()->where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
        }

        $validatedData['slug'] = $slug;

        // Delete old image and upload new image
        if ($request->hasFile('image')) {

            if (
                $productCategory->image &&
                Storage::disk('public')->exists($productCategory->image)
            ) {
                Storage::disk('public')->delete($productCategory->image);
            }

            $validatedData['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $productCategory->update($validatedData);

        return redirect()
            ->route('product_categories.index')
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
