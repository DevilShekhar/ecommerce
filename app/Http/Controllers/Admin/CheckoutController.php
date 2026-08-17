<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::where('id', $productId)
            ->where('status', 1)
            ->first();

        if (! $product) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.',
                ], 404);
            }

            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        // Total quantity for cart badge
        $cartCount = collect($cart)->sum('quantity');

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully.',
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()
            ->with('success', 'Product added to cart successfully.');
    }

    /**
     * Checkout page
     */
    public function checkout()
    {
        $user = Auth::user();

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('shop')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $wishlistCount = Wishlist::where('user_id', $user->id)->count();

        $categories = ProductCategory::where('status', 1)
            ->latest()
            ->take(7)
            ->get();

        $cartCount = collect($cart)->sum('quantity');

        return view('customer.checkout', compact(
            'user',
            'cart',
            'subtotal',
            'wishlistCount',
            'cartCount',
            'categories'
        ));
    }
}
