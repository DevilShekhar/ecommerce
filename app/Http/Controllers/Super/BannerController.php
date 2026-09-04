<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with(['category', 'product'])
            ->latest()
            ->get();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        $categories = ProductCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        $products = Product::where('status', 1)
            ->orderBy('name')
            ->get();

        // No need to pass $banners here
        return view('admin.banners.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        // Basic validation
        $request->validate([
            'title' => 'nullable|string|max:255',
            'banner_type' => 'required|in:homepage_slider,promotional,category,festival,popup,mobile',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'category_id' => 'nullable|exists:product_categories,id',
            'link_type' => 'required|in:none,custom_url,product,category',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // If Custom URL selected
        if ($request->link_type == 'custom_url') {
            $request->validate([
                'link_value' => 'required|string|max:1000',
            ]);
        }

        // If Product selected
        if ($request->link_type == 'product') {
            $request->validate([
                'link_value' => 'required|exists:products,id',
            ]);
        }

        // If Category selected
        if ($request->link_type == 'category') {
            $request->validate([
                'link_value' => 'required|exists:product_categories,id',
            ]);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('banners', 'public');
        }

        // If None selected, save NULL
        if ($request->link_type == 'none') {
            $linkValue = null;
        } else {
            $linkValue = $request->link_value;
        }

        Banner::create([
            'title' => $request->title,
            'banner_type' => $request->banner_type,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'link_type' => $request->link_type,
            'link_value' => $linkValue,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        $categories = ProductCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        $products = Product::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.banners.edit', compact('banner', 'categories', 'products'));
    }

    public function update(Request $request, Banner $banner)
    {
        // Basic validation
        $request->validate([
            'title' => 'nullable|string|max:255',
            'banner_type' => 'required|in:homepage_slider,promotional,category,festival,popup,mobile',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'category_id' => 'nullable|exists:product_categories,id',
            'link_type' => 'required|in:none,custom_url,product,category',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Custom URL
        if ($request->link_type == 'custom_url') {
            $request->validate([
                'link_value' => 'required|string|max:1000',
            ]);
        }

        // Product
        if ($request->link_type == 'product') {
            $request->validate([
                'link_value' => 'required|exists:products,id',
            ]);
        }

        // Category
        if ($request->link_type == 'category') {
            $request->validate([
                'link_value' => 'required|exists:product_categories,id',
            ]);
        }

        $imagePath = $banner->image;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            // Upload new image
            $imagePath = $request->file('image')
                ->store('banners', 'public');
        }

        if ($request->link_type == 'none') {
            $linkValue = null;
        } else {
            $linkValue = $request->link_value;
        }

        $banner->update([
            'title' => $request->title,
            'banner_type' => $request->banner_type,
            'image' => $imagePath,
            'category_id' => $request->banner_type == 'category'
                ? $request->category_id
                : null,
            'link_type' => $request->link_type,
            'link_value' => $linkValue,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->update([
            'status' => 0,
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
