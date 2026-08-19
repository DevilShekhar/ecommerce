<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class OrderReturnController extends Controller
{
    public function show(OrderReturn $return)
    {

        $return->load([
            'order',
            'user',
            'product',
            'orderItem',
            'approvedBy',
            'rejectedBy',
        ]);

        return view('customer.orders', compact('return'));
    }

    /**
     * Super Admin approves return.
     */
    public function approve(Request $request, OrderReturn $return)
    {
        abort_unless(Auth::user()->hasRole('SuperAdmin'), 403);
        if ($return->status !== 'return_requested') {
            return back()->with('error', 'This return request has already been processed.');
        }
        try {
            DB::transaction(function () use ($request, $return) {
                $return->update([
                    'status' => 'approved',
                    'approved_by' => Auth::id(),
                    'approved_at' => now(),
                    'admin_note' => $request->admin_note ?? $return->admin_note,
                ]);

                $return->order->update([
                    'order_status' => 'return_approved',
                ]);
            });

            return back()->with('success', 'Return request approved successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to approve return request.');
        }
    }

    /**
     * Super Admin rejects return.
     */
    public function reject(Request $request, OrderReturn $return)
    {
        abort_unless(
            Auth::user()->hasRole('SuperAdmin'),
            403
        );

        $request->validate([
            'admin_note' => 'required|string|max:1000',
        ]);

        if ($return->status !== 'return_requested') {
            return back()->with(
                'error',
                'This return request has already been processed.'
            );
        }

        DB::transaction(function () use ($request, $return) {

            $return->update([
                'status' => 'rejected',
                'rejected_by' => Auth::id(),
                'rejected_at' => now(),
                'admin_note' => $request->admin_note,
            ]);

            $return->order->update([
                'order_status' => 'return_rejected',
            ]);
        });

        return back()->with(
            'success',
            'Return request rejected.'
        );
    }

    /**
     * Super Admin marks approved return as refunded.
     */
    // public function refund(Request $request, OrderReturn $return)
    // {
    //     abort_unless(
    //         Auth::user()->hasRole('SuperAdmin'),
    //         403
    //     );

    //     if ($return->status !== 'approved') {
    //         return back()->with(
    //             'error',
    //             'Only approved returns can be refunded.'
    //         );
    //     }

    //     DB::transaction(function () use ($return) {

    //         $return->update([
    //             'status' => 'refunded',
    //             'refunded_at' => now(),
    //         ]);

    //         $return->order->update([
    //             'order_status' => 'refunded',
    //             'payment_status' => 'refunded',
    //         ]);
    //     });

    //     return back()->with(
    //         'success',
    //         'Refund marked successfully.'
    //     );
    // }
    public function refund(OrderReturn $return)
    {
        $order = $return->order;

        if (! $order || ! $order->razorpay_payment_id) {
            return back()->with('error', 'Razorpay payment ID not found.');
        }

        if ($return->refund_status === 'refunded') {
            return back()->with('error', 'This refund has already been processed.');
        }

        try {
            $return->update([
                'refund_status' => 'processing',
            ]);

            $api = new Api(
                config('services.razorpay.key'),
                config('services.razorpay.secret')
            );

            $refund = $api->payment
                ->fetch($order->razorpay_payment_id)
                ->refund([
                    'amount' => (int) round($return->refund_amount * 100),
                ]);

            $return->update([
                'status' => 'refunded',
                'refund_status' => 'refunded',
                'refund_method' => 'razorpay',
                'refund_transaction_id' => $refund->id,
                'refunded_at' => now(),
                'refunded_by' => Auth::id(),
            ]);

            $order->update([
                'order_status' => 'refunded',
            ]);

            return back()->with(
                'success',
                'Refund processed successfully through Razorpay.'
            );

        } catch (\Exception $e) {

            $return->update([
                'refund_status' => 'failed',
            ]);

            return back()->with(
                'error',
                'Refund failed: '.$e->getMessage()
            );
        }
    }
}
