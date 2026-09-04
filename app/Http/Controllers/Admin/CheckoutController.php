<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

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

        // Check stock
        if ($product->stock <= 0) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This product is out of stock.',
                ], 400);
            }

            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['quantity'] + 1;
            if ($newQty > $product->stock) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only '.$product->stock.' items available in stock.',
                    ], 400);
                }

                return redirect()->back()->with('error', 'Only '.$product->stock.' items available in stock.');
            }
            $cart[$product->id]['quantity'] = $newQty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'stock' => $product->stock,
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

        // If cart is empty, check if we have localStorage data from AJAX
        if (empty($cart) && request()->has('cart_data')) {
            $cart = json_decode(request()->get('cart_data'), true);
        }

        if ($cart instanceof Collection) {
            $cart = $cart->toArray();
        }

        if (! is_array($cart)) {
            $cart = [];
        }
        $now = now()->toDateString();

        $activeOffers = Offer::query()->where('status', 1)
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->get();
        $cartCount = 0;
        $subtotal = 0;
        $hasOutOfStock = false;
        $hasLowStock = false;

        foreach ($cart as $key => &$item) {

            if (is_object($item)) {
                $item = (array) $item;
            }

            if (! is_array($item)) {
                continue;
            }

            $product = Product::query()->find($item['id'] ?? null);

            if (! $product) {
                continue;
            }
            $quantity = isset($item['quantity']) && is_numeric($item['quantity'])
                ? (int) $item['quantity']
                : 1;

            $quantity = max(1, $quantity);
            $stock = (int) ($product->stock ?? 0);

            if ($stock <= 0) {
                $hasOutOfStock = true;
            }

            if ($stock > 0 && $stock <= 5) {
                $hasLowStock = true;
            }
            $originalPrice = (float) $product->price;

            $discountedPrice = $originalPrice;

            // Product offer
            $offer = $activeOffers->first(function ($o) use ($product) {
                return $o->apply_to === 'product'
                    && $o->product_id == $product->id;
            });

            // Category offer
            if (! $offer) {
                $offer = $activeOffers->first(function ($o) use ($product) {
                    return $o->apply_to === 'category'
                        && $o->product_category_id == $product->category_id;
                });
            }
            if ($offer) {

                if ($offer->discount_type === 'percentage') {

                    $discountedPrice = $originalPrice -
                        ($originalPrice * $offer->discount_value / 100);

                } else {

                    $discountedPrice = max(
                        0,
                        $originalPrice - $offer->discount_value
                    );
                }
            }
            $item['price'] = $discountedPrice;
            $item['original_price'] = $originalPrice;
            $item['discounted_price'] = $discountedPrice;
            $item['active_offer'] = $offer;
            $itemTotal = $discountedPrice * $quantity;
            $subtotal += $itemTotal;
            $cartCount += $quantity;
        }

        unset($item);
        $addresses = $user->address;

        if (is_string($addresses)) {
            $addresses = json_decode($addresses, true);
        }

        if (! is_array($addresses)) {
            $addresses = [];
        }
        $defaultAddress = collect($addresses)
            ->firstWhere('is_default', true);
        $shipping = 0;
        $discount = 0;

        $total = $subtotal + $shipping - $discount;
        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->take(7)
            ->get();
        $recommendedProducts = Product::query()
            ->where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        $recommendedProducts->each(function ($product) use ($activeOffers) {

            // Product offer
            $offer = $activeOffers->first(function ($o) use ($product) {
                return $o->apply_to === 'product'
                    && $o->product_id == $product->id;
            });

            // Category offer
            if (! $offer) {
                $offer = $activeOffers->first(function ($o) use ($product) {
                    return $o->apply_to === 'category'
                        && $o->product_category_id == $product->category_id;
                });
            }

            $product->active_offer = $offer;
        });

        return view('customer.checkout', compact(
            'cart',
            'cartCount',
            'subtotal',
            'shipping',
            'discount',
            'total',
            'user',
            'addresses',
            'defaultAddress',
            'categories',
            'hasOutOfStock',
            'hasLowStock',
            'recommendedProducts'
        ));
    }

    public function syncCart(Request $request)
    {
        $cart = $request->input('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'No cart data found',
            ]);
        }

        $sessionCart = [];

        foreach ($cart as $item) {
            if (empty($item['id'])) {
                continue;
            }

            $sessionCart[] = [
                'id' => $item['id'],
                'name' => $item['name'] ?? '',
                'price' => $item['price'] ?? 0,
                'quantity' => isset($item['quantity']) ? max(1, (int) $item['quantity']) : 1,
                'image' => $item['image'] ?? null,
                'slug' => $item['slug'] ?? null,
            ];
        }

        if (empty($sessionCart)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid cart items found',
            ]);
        }

        session()->put('cart', $sessionCart);
        session()->save();

        $subtotal = collect($sessionCart)->sum(function ($item) {
            return (float) $item['price'] * (int) $item['quantity'];
        });

        session()->put('cart_subtotal', $subtotal);
        session()->save();

        return response()->json([
            'success' => true,
            'cart' => $sessionCart,
            'subtotal' => $subtotal,
        ]);
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
        try {
            $user = Auth::user();

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to continue.',
                ], 401);
            }

            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty.',
                ], 400);
            }

            $subtotal = 0;

            foreach ($cart as $item) {
                $product = Product::query()->find($item['id'] ?? null);

                if (! $product) {
                    continue;
                }

                $price = (float) ($item['price'] ?? $product->price ?? 0);
                $quantity = (int) ($item['quantity'] ?? 1);

                $activeOffer = $item['active_offer'] ?? $product->activeOffer ?? null;

                if ($activeOffer) {
                    $discountValue = (float) $activeOffer->discount_value;

                    if ($activeOffer->discount_type === 'percentage') {
                        $price = $price - ($price * $discountValue / 100);
                    } else {
                        $price = $price - $discountValue;
                    }

                    $price = max($price, 0);
                }

                $subtotal += $price * $quantity;
            }

            $subtotal = round($subtotal, 2);

            $discount = 0;
            $discountType = null;
            $discountCode = null;

            if (session()->has('applied_coupon_discount')) {
                $discount = (float) session()->get('applied_coupon_discount', 0);
                $discountCode = session()->get('applied_coupon_code');

                if ($discount > 0) {
                    $discountType = 'coupon';
                }
            }

            if ($discount <= 0 && session()->has('coupon_discount_amount')) {
                $discount = (float) session()->get('coupon_discount_amount', 0);
                $discountCode = session()->get('coupon_code_applied');

                if ($discount > 0) {
                    $discountType = 'coupon';
                }
            }

            $discount = min($discount, $subtotal);
            $discount = round($discount, 2);

            $shipping = (float) session()->get('shipping', 0);

            if ($subtotal > 999) {
                $shipping = 0;
            }

            $shipping = round($shipping, 2);

            $tax = 0;

            $finalTotal = $subtotal + $shipping + $tax - $discount;
            $finalTotal = max($finalTotal, 0);
            $finalTotal = round($finalTotal, 2);

            Log::info('=== PLACE ORDER CALCULATIONS ===', [
                'subtotal' => $subtotal,
                'discount' => $discount,
                'discount_type' => $discountType,
                'discount_code' => $discountCode,
                'shipping' => $shipping,
                'tax' => $tax,
                'final_total' => $finalTotal,
                'payment_method' => $request->payment_method,
            ]);

            if ($finalTotal <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid order amount. Please check your cart.',
                ], 400);
            }

            $orderNumber = 'ORD-'.date('YmdHis').'-'.strtoupper(substr(uniqid(), -5));

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'discount_type' => $discountType,
                'discount_code' => $discountCode,
                'discount' => $discount,
                'coupon_code' => $discountType === 'coupon' ? $discountCode : null,
                'coupon_discount' => $discountType === 'coupon' ? $discount : 0,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $finalTotal,
                'status' => 'pending',
                'order_status' => 'pending',
                'payment_method' => $request->payment_method ?? 'online',
                'payment_status' => 'pending',
                'notes' => $request->notes ?? '',
            ]);
            foreach ($cart as $item) {
                $product = Product::query()->find($item['id'] ?? null);

                if (! $product) {
                    continue;
                }

                $price = (float) ($item['price'] ?? $product->price ?? 0);
                $quantity = (int) ($item['quantity'] ?? 1);

                $activeOffer = $item['active_offer'] ?? $product->activeOffer ?? null;

                if ($activeOffer) {
                    $discountValue = (float) $activeOffer->discount_value;

                    if ($activeOffer->discount_type === 'percentage') {
                        $price = $price - ($price * $discountValue / 100);
                    } else {
                        $price = $price - $discountValue;
                    }

                    $price = max($price, 0);
                }

                $itemTotal = $price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $itemTotal,
                    'total' => $itemTotal,
                ]);
            }

            Log::info('=== ORDER CREATED WITH ITEMS ===', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'subtotal' => $order->subtotal,
                'discount_amount' => $order->discount_amount,
                'coupon_discount' => $order->coupon_discount,
                'total' => $order->total,
                'items_count' => $order->items()->count(),
            ]);

            // Clear session
            session()->forget([
                'cart',
                'applied_coupon_discount',
                'applied_coupon_code',
                'applied_coupon_id',
                'applied_coupon_data',
                'coupon_discount_amount',
                'coupon_code_applied',
                'coupon_final_amount',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'order' => $order,
                'redirect_url' => route('customer.orders.show', $order->id),
            ]);

        } catch (\Exception $e) {
            Log::error('Order placement failed: '.$e->getMessage());
            Log::error('Stack trace: '.$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to place order: '.$e->getMessage(),
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

            $product = Product::query()->find($cart[$key]['id']);

            if (! $product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.',
                ], 404);
            }

            // Check stock
            if ($quantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only '.$product->stock.' items available in stock.',
                ], 400);
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
        try {
            $couponCode = $request->input('coupon_code');
            $orderAmount = $request->input('order_amount');

            Log::info('=== APPLYING COUPON ===');
            Log::info('Coupon Code:', ['code' => $couponCode]);
            Log::info('Order Amount:', ['amount' => $orderAmount]);

            // Find the coupon
            $coupon = Coupon::query()
                ->where('code', strtoupper(trim($couponCode)))
                ->first();

            if (! $coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code.',
                ], 404);
            }

            // Check coupon status
            if ((int) $coupon->status !== 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon is currently inactive and cannot be used.',
                ], 400);
            }
            if (! $coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code.',
                ], 404);
            }

            // Check if coupon is valid
            $now = now();
            if ($coupon->expires_at && $coupon->expires_at < $now) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon has expired.',
                ], 400);
            }

            if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon usage limit has been reached.',
                ], 400);
            }

            // Calculate discount
            $discountAmount = 0;
            if ($coupon->discount_type === 'percentage') {
                $discountAmount = ($orderAmount * $coupon->discount_value) / 100;
            } else {
                $discountAmount = $coupon->discount_value;
            }

            // Cap discount at order amount
            $discountAmount = min($discountAmount, $orderAmount);

            // Apply minimum order amount check
            if ($coupon->minimum_order_amount && $orderAmount < $coupon->minimum_order_amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Minimum order amount of ₹'.number_format($coupon->minimum_order_amount, 0).' required.',
                ], 400);
            }

            // Store coupon details in session
            session([
                'applied_coupon_code' => $coupon->code,
                'applied_coupon_discount' => $discountAmount,
                'applied_coupon_id' => $coupon->id,
                'applied_coupon_data' => [
                    'code' => $coupon->code,
                    'discount_type' => $coupon->discount_type,
                    'discount_value' => $coupon->discount_value,
                    'discount_amount' => $discountAmount,
                ],
                'coupon_discount_amount' => $discountAmount,
                'coupon_code_applied' => $coupon->code,
                'coupon_final_amount' => $orderAmount - $discountAmount,
            ]);

            session()->save();

            Log::info('Coupon applied and session saved:', [
                'code' => $couponCode,
                'discount_amount' => $discountAmount,
                'final_amount' => $orderAmount - $discountAmount,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully!',
                'coupon' => $coupon,
                'discount_amount' => $discountAmount,
                'final_amount' => $orderAmount - $discountAmount,
                'formatted_discount' => '₹'.number_format($discountAmount, 0),
                'formatted_final' => '₹'.number_format($orderAmount - $discountAmount, 0),
            ]);

        } catch (\Exception $e) {
            Log::error('Coupon application error:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to apply coupon. Please try again.',
            ], 500);
        }
    }

    public function createRazorpayOrder(Request $request)
    {
        try {
            $user = Auth::user();

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to continue.',
                ], 401);
            }

            $cart = session()->get('cart', []);

            if (empty($cart)) {
                Log::warning('Cart is empty');

                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty.',
                ], 400);
            }

            // ============================================================
            // USE THE TOTAL PASSED FROM FRONTEND
            // ============================================================
            $finalTotal = $request->input('final_total', 0);
            $subtotal = $request->input('subtotal', 0);
            $couponCode = $request->input('coupon_code');

            Log::info('=== CREATE RAZORPAY ORDER ===');
            Log::info('Final Total from frontend:', ['total' => $finalTotal]);
            Log::info('Subtotal from frontend:', ['subtotal' => $subtotal]);
            Log::info('Coupon Code:', ['code' => $couponCode]);

            // If frontend didn't send total, calculate it
            if ($finalTotal == 0) {
                // Calculate subtotal from cart
                $subtotal = 0;
                foreach ($cart as $key => $item) {
                    $product = Product::query()->find($item['id'] ?? null);
                    $price = $item['price'] ?? 0;
                    $quantity = $item['quantity'] ?? 1;

                    $activeOffer = $item['active_offer'] ?? $product?->activeOffer ?? null;
                    if ($activeOffer) {
                        $discountValue = (float) $activeOffer->discount_value;
                        if ($activeOffer->discount_type === 'percentage') {
                            $discountedPrice = $price - ($price * $discountValue / 100);
                        } else {
                            $discountedPrice = $price - $discountValue;
                        }
                        $discountedPrice = max(0, $discountedPrice);
                        $price = $discountedPrice;
                    }

                    $subtotal += $price * $quantity;
                }

                // Get discount from session
                $discount = (float) session()->get('applied_coupon_discount', 0);
                $shipping = (float) session()->get('shipping', 0);
                $finalTotal = $subtotal + $shipping - $discount;
                $finalTotal = max($finalTotal, 0);
            }
            if ($finalTotal <= 0) {
                Log::warning('Total amount is zero or negative:', ['total' => $finalTotal]);

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid order amount. Please check your cart.',
                ], 400);
            }

            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $razorpayOrder = $api->order->create([
                'receipt' => 'order_'.time(),
                'amount' => (int) round($finalTotal * 100),
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);
            Log::info('Razorpay Order Created:', [
                'id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'amount_in_rupees' => $razorpayOrder['amount'] / 100,
                'currency' => $razorpayOrder['currency'],
                'status' => $razorpayOrder['status'],
            ]);

            return response()->json([
                'success' => true,
                'key' => config('services.razorpay.key'),
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => 'INR',
                'name' => config('app.name'),
                'description' => 'Order Payment',
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'contact' => $user->phone ?? '',
                ],
                'notes' => [
                    'user_id' => $user->id,
                    'final_amount' => $finalTotal,
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: '.$e->getMessage());
            Log::error('Exception trace:', ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to initialize payment. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyRazorpayPayment(Request $request)
    {
        try {
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                'address_id' => 'nullable',
                'payment_method' => 'required|string|in:upi,card,netbanking,razorpay',
                'notes' => 'nullable|string|max:1000',
            ]);

            Log::info('=== VERIFYING RAZORPAY PAYMENT ===');

            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            Log::info('Payment signature verified successfully');

            // Place order
            $orderRequest = new Request([
                'address_id' => $request->address_id,
                'payment_method' => 'razorpay',
                'notes' => $request->notes,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);

            $response = $this->placeOrder($orderRequest);

            if ($response->getStatusCode() === 200) {
                $data = $response->getData();

                return response()->json([
                    'success' => true,
                    'message' => 'Payment verified and order placed successfully!',
                    'order_id' => $data->order_id ?? null,
                    'order_number' => $data->order_number ?? null,
                    'redirect_url' => route('customer.dashboard'),
                ]);
            }

            return $response;

        } catch (\Exception $e) {
            Log::error('Razorpay verification failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: '.$e->getMessage(),
            ], 422);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'email' => 'nullable|email',
        ]);

        $user = Auth::user();

        // Get email from request first, otherwise use logged-in user's email
        $email = $request->input('email');

        if (empty($email) && $user && ! empty($user->email)) {
            $email = $user->email;
        }

        // Final validation
        if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.',
            ], 422);
        }

        $email = strtolower(trim($email));

        // Check already registered
        $notification = ProductNotification::where('product_id', $request->product_id)
            ->where('email', $email)
            ->first();

        if ($notification) {
            return response()->json([
                'success' => true,
                'exists' => true,
                'message' => 'You are already registered. We will notify you when this product is available.',
            ]);
        }

        // Store notification
        ProductNotification::create([
            'product_id' => $request->product_id,
            'user_id' => $user?->id,
            'email' => $email,
        ]);

        return response()->json([
            'success' => true,
            'exists' => false,
            'message' => 'You have been registered successfully. We will notify you when this product is available.',
        ]);
    }
}
