<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role?->name === 'SuperAdmin') {

            $orders = Order::with([
                'user',
                'items.product',
            ])
                ->withCount('items')
                ->latest()
                ->paginate(10);

            $categories = ProductCategory::query()->where('status', 1)
                ->orderBy('name')
                ->get();

            return view('admin.orders.index', compact(
                'orders',
                'categories'
            ));
        }
        $orders = Order::where('user_id', $user->id)
            ->with([
                'items.product',
            ])
            ->withCount('items')
            ->latest()
            ->paginate(10);

        $categories = ProductCategory::query()->where('status', 1)
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
    /**
     * Show a single order.
     */
    public function show(Order $order)
    {
        $user = Auth::user();

        $categories = ProductCategory::query()->where('status', 1)
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
            'items.product',
        ]);

        $returnRequest = $order->returns()->latest()->first();

        $isSuperAdmin = Auth::check() && Auth::user()->role?->name === 'SuperAdmin';

        return view('admin.orders.show', compact(
            'order',
            'categories',
            'orders',
            'returnRequest',
            'isSuperAdmin'
        ));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,packed,shipped,out_for_delivery,delivered,return_requested,returned,refunded,cancelled',
            ],
        ]);

        $currentStatus = strtolower($order->order_status ?? 'pending');
        $newStatus = strtolower($request->status);

        $allowedTransitions = [
            'pending' => [
                'confirmed',
                'cancelled',
            ],

            'confirmed' => [
                'processing',
                'cancelled',
            ],

            'processing' => [
                'packed',
                'cancelled',
            ],

            'packed' => [
                'shipped',
                'cancelled',
            ],

            'shipped' => [
                'out_for_delivery',
            ],

            'out_for_delivery' => [
                'delivered',
            ],

            'delivered' => [
                'return_requested',
            ],

            'return_requested' => [
                'returned',
            ],

            'returned' => [
                'refunded',
            ],

            'cancelled' => [],

            'refunded' => [],
        ];

        if (
            ! isset($allowedTransitions[$currentStatus]) ||
            ! in_array($newStatus, $allowedTransitions[$currentStatus])
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Invalid status transition from '.
                    ucwords(str_replace('_', ' ', $currentStatus)).
                    ' to '.
                    ucwords(str_replace('_', ' ', $newStatus))
                );
        }

        $updateData = [
            'order_status' => $newStatus,
            'status_updated_by' => Auth::id(),
            'status_updated_at' => now(),
        ];

        if ($newStatus === 'return_requested') {
            $updateData['return_requested_at'] = now();
        }

        if ($newStatus === 'returned') {
            $updateData['returned_at'] = now();
        }

        if ($newStatus === 'refunded') {
            $updateData['refunded_at'] = now();
        }

        $order->update($updateData);

        return redirect()
            ->route('orders.show', $order->id)
            ->with(
                'success',
                'Order status updated to '.
                ucwords(str_replace('_', ' ', $newStatus)).
                ' successfully.'
            );
    }

    public function cancel(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'cancellation_reason' => 'required|string|max:255',
        ]);

        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Customer can cancel only while order is pending
        if (strtolower($order->order_status) !== 'pending') {
            return redirect()
                ->route('customer.orders.index')
                ->with('error', 'This order can no longer be cancelled.');
        }

        $order->update([
            'order_status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        return redirect()
            ->route('customer.orders.index')
            ->with('success', 'Your order has been cancelled successfully.');
    }

    public function requestReturn(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
        if (strtolower($order->order_status) !== 'delivered') {
            return redirect()->back()->with('error', 'This order cannot be returned. Order must be delivered.');
        }
        $request->validate([
            'return_reason' => 'required|string|max:500',
            'return_notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();
            $firstItem = $order->items()->first();
            $orderReturn = OrderReturn::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'order_item_id' => $firstItem?->id ?? null,
                'reason' => $request->return_reason,
                'customer_note' => $request->return_notes,
                'quantity' => $firstItem?->quantity ?? 1,
                'refund_amount' => $order->total,
                'status' => 'return_requested',
            ]);

            // Update order status
            $order->update([
                'order_status' => 'return_requested',
                'return_reason' => $request->return_reason,
                'return_notes' => $request->return_notes,
                'return_requested_at' => now(),
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Return request submitted successfully. We will review it shortly.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Return request failed for order '.$order->id, [
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'Failed to submit return request. Please try again.');
        }
    }
}
