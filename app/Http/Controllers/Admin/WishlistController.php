<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Customer Wishlist
     */
    public function index()
    {
        $user = Auth::user();

        $wishlistItems = Wishlist::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(12);

        $wishlistCount = Wishlist::query()->where('user_id', $user->id)->count();

        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->get();

        return view('customer.wishlist', compact(
            'user',
            'wishlistItems',
            'wishlistCount',
            'categories'
        ));
    }

    /**
     * Add / Remove product from wishlist
     */
    public function toggle(Request $request, $productId)
    {
        // Check product
        $product = Product::query()->where('id', $productId)
            ->where('status', 1)
            ->first();

        if (! $product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $userId = Auth::id();

        // Check existing wishlist
        $existing = Wishlist::query()->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {

            // Remove
            $existing->delete();

            $isInWishlist = false;
            $message = 'Removed from wishlist';

        } else {

            // Add
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            $isInWishlist = true;
            $message = 'Added to wishlist';
        }

        // Updated count
        $wishlistCount = Wishlist::query()->where('user_id', $userId)->count();

        return response()->json([
            'success' => true,
            'is_in_wishlist' => $isInWishlist,
            'message' => $message,
            'wishlist_count' => $wishlistCount,
            'product_id' => $productId,
        ]);
    }

    /**
     * Remove wishlist item
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::query()->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (! $wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found',
            ], 404);
        }

        $wishlist->delete();

        return redirect()
            ->route('customer.wishlist')
            ->with('success', 'Product removed from wishlist.');
    }
    public function remove($id)
    {
        $wishlist = Wishlist::query()->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (! $wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found',
            ], 404);
        }

        $wishlist->delete();

        return redirect()
            ->route('customer.wishlist')
            ->with('success', 'Product removed from wishlist.');
    }
}
