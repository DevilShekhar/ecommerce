<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * SuperAdmin Dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Only SuperAdmin can access
        if (! $user->hasRole('SuperAdmin')) {
            return redirect()->route('customer.dashboard');
        }

        $totalCustomers = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->count();

        $totalProducts = Product::count();
        $totalWishlist = Wishlist::count();

        return view('dashboard', compact(
            'user',
            'totalCustomers',
            'totalProducts',
            'totalWishlist'
        ));
    }

    /**
     * Customer Dashboard
     */
    public function customerDashboard()
    {
        $user = Auth::user();

        // Only customer can access
        if (! $user->hasRole('customer')) {
            return redirect()->route('dashboard');
        }

        // Wishlist
        $wishlistProducts = Wishlist::query()->where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->get();

        $wishlistCount = $wishlistProducts->count();

        // Categories
        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->take(7)
            ->get();

        // Recommended Products
        $recommendedProducts = Product::query()->where('status', 1)
            ->latest()
            ->take(8)
            ->get();
        $banners = Banner::query()->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->get();

        $orderStatusCounts = [
            'pending' => Order::where('order_status', 'pending')->count(),
            'confirmed' => Order::where('order_status', 'confirmed')->count(),
            'processing' => Order::where('order_status', 'processing')->count(),
            'packed' => Order::where('order_status', 'packed')->count(),
            'shipped' => Order::where('order_status', 'shipped')->count(),
            'out_for_delivery' => Order::where('order_status', 'out_for_delivery')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
            'cancelled' => Order::where('order_status', 'cancelled')->count(),
        ];

        return view('customer.dashboard', compact(
            'user',
            'wishlistCount',
            'wishlistProducts',
            'categories',
            'recommendedProducts', 'banners','orderStatusCounts'
        ));
    }

    /**
     * Customer Products
     */
    public function customerProducts()
    {
        $user = Auth::user();

        // Only customer can access
        if (! $user->hasRole('customer')) {
            return redirect()->route('dashboard');
        }

        // Products added to wishlist by this customer
        $wishlistProducts = Wishlist::query()->where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->get();

        $wishlistCount = $wishlistProducts->count();

        // Categories
        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->take(7)
            ->get();
        $recommendedProducts = Product::query()->where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('customer.products', compact(
            'user',
            'wishlistProducts',
            'wishlistCount',
            'categories', 'recommendedProducts'
        ));
    }

    public function getProductDetails($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $images = $product->image
            ? array_values(array_filter(array_map('trim', explode(',', $product->image))))
            : [];

        $firstImage = $images[0] ?? null;

        if ($firstImage) {
            $firstImage = preg_replace('#^storage/#', '', $firstImage);
            $imageUrl = asset($firstImage);
        } else {
            $imageUrl = asset('images/placeholder.png');
        }

        $discount = $product->discount ?? 0;
        $originalPrice = $product->price ?? 0;
        $price = $originalPrice - ($originalPrice * $discount / 100);

        return response()->json([
            'success' => true,

            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name ?? 'Jewellery',
                'price' => $price,
                'formatted_price' => '₹'.number_format($price, 0),
                'image' => $imageUrl,
                'description' => $product->specification ?? 'No product description available.',
                'stock' => $product->stock,
                'is_out_of_stock' => $product->stock !== null && $product->stock <= 0,
                'is_futured' => (int) ($product->is_futured ?? 0) === 1,
            ],
        ]);
    }
}
