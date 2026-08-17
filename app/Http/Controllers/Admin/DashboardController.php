<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        $wishlistProducts = Wishlist::where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->get();

        $wishlistCount = $wishlistProducts->count();

        // Categories
        $categories = ProductCategory::where('status', 1)
            ->latest()
            ->take(7)
            ->get();

        // Recommended Products
        $recommendedProducts = Product::where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('customer.dashboard', compact(
            'user',
            'wishlistCount',
            'wishlistProducts',
            'categories',
            'recommendedProducts'
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
            'categories','recommendedProducts'
        ));
    }
}
