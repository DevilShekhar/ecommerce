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

    // SINGLE DD() - Shows everything about image path
    dd([
        '1_current_record' => $productCategory->toArray(),
        '2_image_path_in_db' => $productCategory->image,
        '3_full_asset_url' => $productCategory->image ? asset('storage/' . $productCategory->image) : null,
        '4_storage_full_path' => $productCategory->image ? storage_path('app/public/' . $productCategory->image) : null,
        '5_public_path' => $productCategory->image ? public_path('storage/' . $productCategory->image) : null,
        '6_file_exists_on_disk' => $productCategory->image ? file_exists(storage_path('app/public/' . $productCategory->image)) : false,
        '7_storage_disk_exists' => $productCategory->image ? Storage::disk('public')->exists($productCategory->image) : false,
        '8_all_files_in_storage' => Storage::disk('public')->files('categories'),
        '9_request_has_file' => $request->hasFile('image'),
        '10_is_valid_file' => $request->hasFile('image') ? $request->file('image')->isValid() : false,
        '11_new_file_details' => $request->hasFile('image') ? [
            'name' => $request->file('image')->getClientOriginalName(),
            'size' => $request->file('image')->getSize(),
            'mime' => $request->file('image')->getMimeType(),
        ] : null,
        '12_env_app_url' => env('APP_URL'),
        '13_storage_link_exists' => file_exists(public_path('storage')),
    ]);

    // Your existing update code...
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

    if ($request->hasFile('image')) {
        if ($productCategory->image) {
            Storage::disk('public')->delete($productCategory->image);
        }

        $path = $request->file('image')->store('categories', 'public');
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
