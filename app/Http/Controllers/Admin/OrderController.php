<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */
        if ($user->role?->name === 'SuperAdmin') {

            $orders = Order::with([
                'user',
                'items.product',
            ])
                ->withCount('items')
                ->latest()
                ->paginate(10);

            $categories = ProductCategory::where('status', 1)
                ->orderBy('name')
                ->get();

            return view('admin.orders.index', compact(
                'orders',
                'categories'
            ));
        }

        /*
        |--------------------------------------------------------------------------
        | Customer
        |--------------------------------------------------------------------------
        */
        $orders = Order::where('user_id', $user->id)
            ->with([
                'items.product',
            ])
            ->withCount('items')
            ->latest()
            ->paginate(10);

        $categories = ProductCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('customer.orders', compact(
            'orders',
            'categories'
        ));
    }

    /**
     * Show a single order.
     */
    public function show(Order $order)
    {
        $user = Auth::user();

        $categories = ProductCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        $orders = Order::with([
            'user',
            'items.product',
        ])
            ->withCount('items')
            ->latest()
            ->paginate(10);
        // Super Admin can view any order
        if ($user->role?->name !== 'SuperAdmin') {

            // Customers can only view their own orders
            if ($order->user_id !== $user->id) {
                abort(403, 'Unauthorized access.');
            }
        }

        $order->load([
            'user',
            'items',
        ]);

        return view('admin.orders.show', compact('order', 'categories', 'orders'));
    }

 public function updateStatus(Request $request, Order $order)
{
    if (auth()->user()->role?->name !== 'SuperAdmin') {
        abort(403, 'Unauthorized access.');
    }

    $statusFlow = [
        'pending' => 'confirmed',
        'confirmed' => 'processing',
        'processing' => 'packed',
        'packed' => 'shipped',
        'shipped' => 'out_for_delivery',
        'out_for_delivery' => 'delivered',
    ];

    $currentStatus = strtolower($order->order_status ?? 'pending');

    if (!isset($statusFlow[$currentStatus])) {
        return back()->with('error', 'This order status cannot be changed further.');
    }

    $nextStatus = $statusFlow[$currentStatus];

    $order->update([
        'order_status' => $nextStatus,
    ]);

    return back()->with(
        'success',
        'Order status changed to ' . ucwords(str_replace('_', ' ', $nextStatus)) . '.'
    );
}
}
