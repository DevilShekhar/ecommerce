<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display shop page with products and filters
     */
    public function index(Request $request)
    {
        // Get all active categories
        $categories = ProductCategory::where('status', 1)->get();

        // Get filter values for sidebar
        $brands = Brand::where('status', 1)->get();
        $materials = Product::where('status', 1)
            ->whereNotNull('variants')
            ->distinct()
            ->pluck('variants')
            ->filter()
            ->values();

        // Get price range
        $priceRange = [
            'min' => Product::where('status', 1)->min('price') ?? 0,
            'max' => Product::where('status', 1)->max('price') ?? 1000
        ];

        // Build query
        $query = Product::with(['category', 'brand', 'subCategory'])
            ->where('status', 1);

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sub_category')) {
            $query->where('sub_category_id', $request->sub_category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('material')) {
            $query->where('variants', 'like', '%' . $request->material . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%')
                  ->orWhere('specification', 'like', '%' . $search . '%');
            });
        }

        // Apply sorting
        $sort = $request->sort ?? 'newest';
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Get products with pagination
        $products = $query->paginate(12)->withQueryString();

        // Get current filters for view
        $filters = [
            'category' => $request->category,
            'sub_category' => $request->sub_category,
            'brand' => $request->brand,
            'material' => $request->material,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'search' => $request->search,
        ];

        return view('frontend.shop.index', compact(
            'products',
            'categories',
            'brands',
            'materials',
            'priceRange',
            'filters',
            'sort'
        ));
    }

    /**
     * Show single product details
     */
    public function show($id)
    {
        $product = Product::with(['category', 'brand', 'subCategory', 'creator'])
            ->where('status', 1)
            ->findOrFail($id);

        // Get related products from same category
        $relatedProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('frontend.shop.show', compact('product', 'relatedProducts'));
    }

    /**
     * Get subcategories for a category (AJAX)
     */
    public function getSubCategories($categoryId)
    {
        $subCategories = \App\Models\SubCategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get(['id', 'name']);

        return response()->json($subCategories);
    }
}
