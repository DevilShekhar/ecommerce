<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with([
            'category',
            'subCategory',
            'brand',
            'creator',
            'inventoryTransactions.creator',
        ])
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = ProductCategory::query()->where('status', 1)->get();
        $subcategories = SubCategory::query()->where('status', 1)->get();
        $brands = Brand::query()->where('status', 1)->get();

        return view('admin.products.create', compact('categories', 'subcategories', 'brands'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'required|exists:sub_category,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'variants' => 'nullable|string',
            'specification' => 'nullable|string',
            'is_futured' => 'required|in:0,1,2',
            'images.*' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // Multiple Image Upload Handling (Saved as Comma-Separated String)
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $imagePaths[] = 'uploads/products/'.$filename;
            }
        }

        // Set default status to 1 (Active) & track logged-in user ID
        $validated['image'] = ! empty($imagePaths) ? implode(',', $imagePaths) : null;
        $validated['status'] = 1;
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::query()->where('status', 1)->get();

        $subcategories = SubCategory::query()->where('category_id', $product->category_id)
            ->where('status', 1)
            ->get();

        $brands = Brand::query()->where('status', 1)->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'brands'));
    }

    /**
     * Update the specified product in storage.
     */
    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'required|exists:sub_category,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,'.$product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'variants' => 'nullable|string',
            'specification' => 'nullable|string',
            'is_featured' => 'required|in:0,1,2',
            'status' => 'required|in:0,1',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        // 1. Get kept existing images submitted from form
        $keptImages = $request->input('existing_images', []);

        // 2. Identify and physically delete removed images from storage
        $oldImages = $product->image ? array_filter(explode(',', $product->image)) : [];
        $removedImages = array_diff($oldImages, $keptImages);

        foreach ($removedImages as $removedImg) {
            if (File::exists(public_path($removedImg))) {
                File::delete(public_path($removedImg));
            }
        }

        // 3. Upload and save new additional images
        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $newImagePaths[] = 'uploads/products/'.$filename;
            }
        }

        // 4. Merge remaining existing images with newly uploaded images
        $finalImages = array_merge($keptImages, $newImagePaths);
        $validated['image'] = ! empty($finalImages) ? implode(',', $finalImages) : null;
        $validated['updated_by'] = Auth::id();

        $product->update($validated);

        return redirect()->route('products.index', $product->id)
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Display the specified product details.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'subCategory', 'brand', 'creator', 'updater']);

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        // Delete uploaded physical images from server
        if ($product->image) {
            $images = explode(',', $product->image);
            foreach ($images as $img) {
                if (File::exists(public_path($img))) {
                    File::delete(public_path($img));
                }
            }
        }

        $product->update([
            'status' => 0,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * AJAX Endpoint: Fetch SubCategories based on selected Category ID.
     */
    public function getSubCategories($category_id)
    {
        $subcategories = SubCategory::query()->where('category_id', $category_id)
            ->where('status', 1)
            ->select('id', 'name')
            ->get();

        return response()->json($subcategories);
    }

    public function addStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'supplier_name' => 'nullable|string|max:255',
            'invoice_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($validated, $product) {

            // Always get the latest stock from DB
            $product->refresh();

            $stockBefore = (int) $product->stock;
            $quantity = (int) $validated['quantity'];
            $stockAfter = $stockBefore + $quantity;

            // Update product's current stock
            $product->update([
                'stock' => $stockAfter,
                'updated_by' => Auth::id(),
            ]);

            // Record inventory transaction
            InventoryTransaction::create([
                'product_id' => $product->id,
                'type' => 'stock_in',
                'quantity' => $quantity,
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,

                'reference_type' => 'manual',
                'reference_id' => null,

                'supplier_name' => $validated['supplier_name'] ?? null,
                'invoice_number' => $validated['invoice_number'] ?? null,
                'notes' => $validated['notes'] ?? null,

                'created_by' => Auth::id(),
            ]);
        });

        return back()->with(
            'success',
            $validated['quantity'].' stock added successfully for '.$product->name.'.'
        );
    }
}
