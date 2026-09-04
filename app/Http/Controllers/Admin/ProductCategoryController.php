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
        ]);

        $validatedData['slug'] = Str::slug($request->name);

        // Debug: Check if file is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Debug: Check file details
            dd([
                'file_exists' => $file->isValid(),
                'original_name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'temp_path' => $file->getRealPath(),
            ]);

            $path = $file->store('categories', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['created_by'] = Auth::id();
        ProductCategory::create($validatedData);

        return redirect()
            ->route('product_categories.index')
            ->with('success', 'Product category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $productCategory = ProductCategory::findOrFail($id);

        // Debug: Check current record before update
        dd([
            'current_record' => $productCategory->toArray(),
            'current_image_path' => $productCategory->image,
            'image_exists_in_storage' => $productCategory->image ? Storage::disk('public')->exists($productCategory->image) : false,
            'full_url' => $productCategory->image ? asset('storage/'.$productCategory->image) : null,
        ]);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,'.$id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_ads' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);
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

        // Debug: Check new file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Delete old image
            if ($productCategory->image) {
                Storage::disk('public')->delete($productCategory->image);
            }

            // Store new image
            $path = $file->store('categories', 'public');
            $validatedData['image'] = $path;
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
