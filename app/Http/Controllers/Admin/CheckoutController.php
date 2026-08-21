<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

        if ($cart instanceof Collection) {
            $cart = $cart->toArray();
        }

        if (! is_array($cart)) {
            $cart = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Active Offers
        |--------------------------------------------------------------------------
        */
        $now = now()->toDateString();

        $activeOffers = Offer::query()->where('status', 1)
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Cart Calculations
        |--------------------------------------------------------------------------
        */
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

            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */
            $quantity = isset($item['quantity']) && is_numeric($item['quantity'])
                ? (int) $item['quantity']
                : 1;

            $quantity = max(1, $quantity);

            /*
            |--------------------------------------------------------------------------
            | Stock
            |--------------------------------------------------------------------------
            */
            $stock = (int) ($product->stock ?? 0);

            if ($stock <= 0) {
                $hasOutOfStock = true;
            }

            if ($stock > 0 && $stock <= 5) {
                $hasLowStock = true;
            }

            /*
            |--------------------------------------------------------------------------
            | Original Price
            |--------------------------------------------------------------------------
            */
            $originalPrice = (float) $product->price;

            $discountedPrice = $originalPrice;

            /*
            |--------------------------------------------------------------------------
            | Find Active Offer
            |--------------------------------------------------------------------------
            */

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

            /*
            |--------------------------------------------------------------------------
            | Calculate Discounted Price
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | Attach Values To Cart Item
            |--------------------------------------------------------------------------
            |
            | This makes the values available directly in Blade.
            |
            */
            $item['price'] = $discountedPrice;
            $item['original_price'] = $originalPrice;
            $item['discounted_price'] = $discountedPrice;
            $item['active_offer'] = $offer;

            /*
            |--------------------------------------------------------------------------
            | Item Total
            |--------------------------------------------------------------------------
            */
            $itemTotal = $discountedPrice * $quantity;

            $subtotal += $itemTotal;

            $cartCount += $quantity;
        }

        unset($item);

        /*
        |--------------------------------------------------------------------------
        | Addresses
        |--------------------------------------------------------------------------
        */
        $addresses = $user->address;

        if (is_string($addresses)) {
            $addresses = json_decode($addresses, true);
        }

        if (! is_array($addresses)) {
            $addresses = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Default Address
        |--------------------------------------------------------------------------
        */
        $defaultAddress = collect($addresses)
            ->firstWhere('is_default', true);

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */
        $shipping = 0;
        $discount = 0;

        $total = $subtotal + $shipping - $discount;

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->take(7)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recommended Products
        |--------------------------------------------------------------------------
        */
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

            // Fix: Add 'razorpay' to the validation rules
            $request->validate([
                'address_id' => 'nullable',
                'payment_method' => 'required|string|in:cod,upi,card,netbanking,razorpay',
                'notes' => 'nullable|string|max:1000',
                'razorpay_payment_id' => 'nullable|string',
                'razorpay_order_id' => 'nullable|string',
                'razorpay_signature' => 'nullable|string',
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

            if (! $selectedAddress) {
                $selectedAddress = [
                    'address' => $user->location_address ?? '',
                    'city' => $user->city ?? '',
                    'state' => $user->state ?? '',
                    'country' => $user->country ?? '',
                    'pincode' => $user->pincode ?? '',
                ];
            }

            $shippingAddress = $selectedAddress['address'] ?? $user->location_address ?? '';
            $shippingCity = $selectedAddress['city'] ?? $user->city ?? '';
            $shippingState = $selectedAddress['state'] ?? $user->state ?? '';
            $shippingCountry = $selectedAddress['country'] ?? $user->country ?? '';
            $shippingPincode = $selectedAddress['pincode'] ?? $user->pincode ?? '';

            $latitude = $selectedAddress['latitude'] ?? $user->latitude ?? null;
            $longitude = $selectedAddress['longitude'] ?? $user->longitude ?? null;

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

                if ($product->stock < $quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only '.$product->stock.' '.$product->name.' available in stock.',
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

            DB::beginTransaction();

            try {
                $orderNumber = 'ORD-'.now()->format('YmdHis').'-'.strtoupper(substr(uniqid(), -5));

                $paymentStatus = 'pending';
                $paymentMethod = $request->payment_method;

                // If payment method is 'razorpay' or has razorpay payment id, mark as paid
                if ($paymentMethod === 'razorpay' || $request->razorpay_payment_id) {
                    $paymentStatus = 'paid';
                    $paymentMethod = 'razorpay'; // Normalize to razorpay
                } elseif ($paymentMethod === 'cod') {
                    $paymentStatus = 'pending';
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => $orderNumber,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'discount' => $discount,
                    'total' => $total,
                    'payment_method' => $paymentMethod,
                    'payment_status' => $paymentStatus,
                    'order_status' => 'pending',
                    'shipping_address' => $shippingAddress,
                    'shipping_city' => $shippingCity,
                    'shipping_state' => $shippingState,
                    'shipping_country' => $shippingCountry,
                    'shipping_pincode' => $shippingPincode,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'notes' => $request->notes,
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
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

                    $product->query()->decrement('stock', $item['quantity']);
                }
                $order->load([
                    'user',
                    'items.product',
                ]);

                DB::commit();

                try {

                    if ($order->user?->email) {
                        Mail::to($order->user->email)
                            ->send(new OrderPlacedMail($order, false));
                    }

                    if (config('mail.super_admin_email')) {
                        Mail::to(config('mail.super_admin_email'))
                            ->send(new OrderPlacedMail($order, true));
                    }

                } catch (\Exception $e) {

                    Log::error('Order confirmation email failed', [
                        'order_id' => $order->id,
                        'error' => $e->getMessage(),
                    ]);
                }

                session()->forget('cart');

                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully! Your order has been confirmed.',
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'total' => $order->total,
                    'redirect_url' => route('customer.dashboard'),
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Order creation failed: '.$e->getMessage());
                Log::error('Stack trace: '.$e->getTraceAsString());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create order: '.$e->getMessage(),
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Place order error: '.$e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

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

        if ($coupon->start_date && $today->lt($coupon->start_date)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is not active yet.',
            ], 422);
        }

        if ($coupon->end_date && $today->gt($coupon->end_date)) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon has expired.',
            ], 422);
        }

        if (
            ! is_null($coupon->usage_limit) &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon usage limit has been reached.',
            ], 422);
        }

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

        if ($coupon->discount_type === 'percentage') {
            $discountAmount = ($orderAmount * $coupon->discount_value) / 100;

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
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty.',
                ], 400);
            }

            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            }

            $discount = (float) session()->get('applied_coupon_discount', 0);
            $shipping = (float) session()->get('shipping', 0);

            $total = $subtotal + $shipping - $discount;
            $total = max($total, 0);

            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $razorpayOrder = $api->order->create([
                'receipt' => 'order_'.time(),
                'amount' => (int) round($total * 100),
                'currency' => 'INR',
                'payment_capture' => 1,
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
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Unable to initialize payment. Please try again.',
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

            // Payment verified - place order with razorpay as payment method
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
            Log::error('Stack trace: '.$e->getTraceAsString());

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
