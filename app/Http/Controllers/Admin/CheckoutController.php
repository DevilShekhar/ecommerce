<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::query()->where('id', $productId)
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

        if ($cart instanceof Collection) {
            $cart = $cart->toArray();
        }

        if (! is_array($cart)) {
            $cart = [];
        }

        $cartCount = count($cart);

        $subtotal = 0;

        foreach ($cart as $item) {
            if (is_object($item)) {
                $item = (array) $item;
            }

            if (! is_array($item)) {
                continue;
            }

            $price = $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 1;

            if (is_array($price)) {
                $price = 0;
            }

            if (is_array($quantity)) {
                $quantity = 1;
            }

            $subtotal += (float) $price * (int) $quantity;
        }

        $addresses = $user->address;

        if (is_string($addresses)) {
            $addresses = json_decode($addresses, true);
        }

        if (! is_array($addresses)) {
            $addresses = [];
        }

        // Find default address
        $defaultAddress = collect($addresses)
            ->firstWhere('is_default', true);

        $shipping = 0;
        $discount = 0;
        $total = $subtotal + $shipping - $discount;
        $categories = ProductCategory::where('status', 1)
            ->latest()
            ->take(7)
            ->get();

        return view('customer.checkout', compact(
            'cart',
            'cartCount',
            'subtotal',
            'shipping',
            'discount',
            'total',
            'user',
            'addresses',
            'defaultAddress', 'categories'
        ));
    }

    public function removeFromCart($key)
    {

        try {
            $cart = session()->get('cart', []);

            if (isset($cart[$key])) {
                unset($cart[$key]);
                session()->put('cart', $cart);

                // Recalculate totals
                $subtotal = 0;
                foreach ($cart as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from cart.',
                    'cart_count' => count($cart),
                    'subtotal' => $subtotal,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart.',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item: '.$e->getMessage(),
            ], 500);
        }
    }

    public function placeOrder(Request $request)
    {
        // dd($request->all());
        try {
            $user = Auth::user();

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to place order.',
                ], 401);
            }

            $cart = session()->get('cart', []);

            if (empty($cart) || ! is_array($cart)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty.',
                ], 400);
            }

            $request->validate([
                'address_id' => 'nullable',
                'payment_method' => 'required|string|in:cod,upi,card',
                'notes' => 'nullable|string|max:1000',
            ]);

            $addresses = $user->address;

            if (is_string($addresses)) {
                $addresses = json_decode($addresses, true);
            }

            if (! is_array($addresses)) {
                $addresses = [];
            }

            $addressId = $request->address_id;

            $selectedAddress = null;

            if ($addressId !== null) {
                foreach ($addresses as $address) {
                    if (
                        isset($address['id']) &&
                        (string) $address['id'] === (string) $addressId
                    ) {
                        $selectedAddress = $address;
                        break;
                    }
                }
            }
            if (! $selectedAddress) {
                $selectedAddress = collect($addresses)
                    ->firstWhere('is_default', true);
            }
            $shippingAddress = $selectedAddress['address'] ?? $user->location_address ?? '';
            $shippingCity = $selectedAddress['city'] ?? $user->city ?? '';
            $shippingState = $selectedAddress['state'] ?? $user->state ?? '';
            $shippingCountry = $selectedAddress['country'] ?? $user->country ?? '';
            $shippingPincode = $selectedAddress['pincode'] ?? $user->pincode ?? '';

            $latitude = $selectedAddress['latitude'] ?? $user->latitude;
            $longitude = $selectedAddress['longitude'] ?? $user->longitude;

            $shipping = 0;
            $discount = 0;
            $subtotal = 0;

            $orderItems = [];

            foreach ($cart as $cartItem) {
                if (! is_array($cartItem)) {
                    continue;
                }

                $productId = $cartItem['id'] ?? null;
                $quantity = (int) ($cartItem['quantity'] ?? 1);

                if (! $productId || $quantity < 1) {
                    continue;
                }

                /*
                 * Always retrieve the product from DB.
                 */
                $product = Product::with([
                    'category',
                    'subCategory',
                    'brand',
                ])->where('id', $productId)
                    ->where('status', 1)
                    ->first();

                if (! $product) {
                    return response()->json([
                        'success' => false,
                        'message' => 'One of the products in your cart is no longer available.',
                    ], 400);
                }
                $price = (float) $product->price;
                $itemTotal = $price * $quantity;

                $subtotal += $itemTotal;

                $orderItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $itemTotal,
                ];
            }

            if (empty($orderItems)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid products found in your cart.',
                ], 400);
            }

            $total = $subtotal + $shipping - $discount;

            $order = DB::transaction(function () use (
                $user,
                $orderItems,
                $subtotal,
                $shipping,
                $discount,
                $total,
                $shippingAddress,
                $shippingCity,
                $shippingState,
                $shippingCountry,
                $shippingPincode,
                $latitude,
                $longitude,
                $request) {
                /*
                 * Generate unique order number.
                 */
                $orderNumber = 'ORD-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -5));

                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => $orderNumber,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'discount' => $discount,
                    'total' => $total,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $request->payment_method === 'cod'
                        ? 'pending'
                        : 'pending',
                    'order_status' => 'pending',
                    'shipping_address' => $shippingAddress,
                    'shipping_city' => $shippingCity,
                    'shipping_state' => $shippingState,
                    'shipping_country' => $shippingCountry,
                    'shipping_pincode' => $shippingPincode,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'notes' => $request->notes,
                ]);

                foreach ($orderItems as $item) {
                    $product = $item['product'];

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'category_id' => $product->category_id,
                        'sub_category_id' => $product->sub_category_id,
                        'brand_id' => $product->brand_id,
                        'product_name' => $product->name,
                        'sku' => $product->sku,
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $item['total'],
                        'image' => $product->image,
                        'variants' => $product->variants,
                        'specification' => $product->specification,
                    ]);

                    /*
                     * Reduce product stock.
                     */
                    $product->decrement('stock', $item['quantity']);
                }

                return $order;
            });

            /*
             * Clear cart only after successful order creation.
             */
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully! Your order has been confirmed.',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'total' => $order->total,
            ]);

        } catch (\Exception $e) {
            Log::error('Place order error: '.$e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to place order. Please try again.',
            ], 500);
        }
    }

    public function updateCart(Request $request, $key)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $cart = session()->get('cart', []);

            if (! isset($cart[$key])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found in cart.',
                ], 404);
            }

            $quantity = (int) $request->quantity;

            $product = Product::find($cart[$key]['id']);

            if (! $product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.',
                ], 404);
            }

            $cart[$key]['quantity'] = $quantity;

            session()->put('cart', $cart);

            $subtotal = 0;
            $cartCount = 0;

            foreach ($cart as $item) {
                $price = isset($item['price']) && is_numeric($item['price'])
                    ? (float) $item['price']
                    : 0;

                $itemQuantity = isset($item['quantity']) && is_numeric($item['quantity'])
                    ? (int) $item['quantity']
                    : 0;

                $subtotal += $price * $itemQuantity;
                $cartCount += $itemQuantity;
            }

            $shipping = 0;
            $discount = 0;
            $total = $subtotal + $shipping - $discount;

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully.',
                'quantity' => $quantity,
                'cart_count' => $cartCount,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'discount' => $discount,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart: '.$e->getMessage(),
            ], 500);
        }
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => ['required', 'string', 'max:100'],
            'order_amount' => ['required', 'numeric', 'min:0'],
        ]);

        $couponCode = strtoupper(trim($request->coupon_code));
        $orderAmount = (float) $request->order_amount;

        $coupon = Coupon::query()->where('code', $couponCode)
            ->where('status', true)
            ->first();

        if (! $coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or inactive coupon code.',
            ], 422);
        }

        $today = Carbon::today();

        // Check start date
        if ($coupon->start_date && $today->lt($coupon->start_date)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is not active yet.',
            ], 422);
        }

        // Check expiry date
        if ($coupon->end_date && $today->gt($coupon->end_date)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon has expired.',
            ], 422);
        }

        // Check usage limit
        if (
            ! is_null($coupon->usage_limit) &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon usage limit has been reached.',
            ], 422);
        }

        // Check minimum order amount
        if (
            $coupon->minimum_order_amount > 0 &&
            $orderAmount < $coupon->minimum_order_amount
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount for this coupon is ₹'.
                    number_format($coupon->minimum_order_amount, 0),
            ], 422);
        }

        $discountAmount = 0;

        // Percentage discount
        if ($coupon->discount_type === 'percentage') {

            $discountAmount = ($orderAmount * $coupon->discount_value) / 100;

            // Apply maximum discount limit
            if (
                ! is_null($coupon->maximum_discount) &&
                $coupon->maximum_discount > 0 &&
                $discountAmount > $coupon->maximum_discount
            ) {
                $discountAmount = (float) $coupon->maximum_discount;
            }

        } elseif ($coupon->discount_type === 'flat') {

            $discountAmount = (float) $coupon->discount_value;
        }

        // Discount should never exceed order amount
        $discountAmount = min($discountAmount, $orderAmount);

        $finalAmount = max($orderAmount - $discountAmount, 0);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'coupon' => [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'discount_type' => $coupon->discount_type,
                'discount_value' => $coupon->discount_value,
            ],
            'original_amount' => round($orderAmount, 2),
            'discount_amount' => round($discountAmount, 2),
            'final_amount' => round($finalAmount, 2),
        ]);
    }
}
