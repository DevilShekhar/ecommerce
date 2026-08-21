<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        {{ $isSuperAdmin ? 'New Order Received' : 'Order Placed Successfully' }}
    </title>
</head>

<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, sans-serif;">

    <div style="max-width:650px; margin:30px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div style="background:#0d6efd; padding:25px; text-align:center;">

            @if($isSuperAdmin)

                <h1 style="margin:0; color:#ffffff; font-size:24px;">
                    🛍️ New Order Received
                </h1>

            @else

                <h1 style="margin:0; color:#ffffff; font-size:24px;">
                    Order Placed Successfully! 🎉
                </h1>

            @endif

        </div>


        {{-- ========================================================= --}}
        {{-- CONTENT --}}
        {{-- ========================================================= --}}

        <div style="padding:30px; color:#333333;">

            @if($isSuperAdmin)

                {{-- ================================================= --}}
                {{-- SUPER ADMIN EMAIL --}}
                {{-- ================================================= --}}

                <h2 style="margin-top:0;">
                    New Order Received
                </h2>

                <p>
                    A new order has been successfully placed on
                    <strong>{{ config('app.name') }}</strong>.
                </p>

                {{-- Customer Details --}}

                <div style="
                    background:#f8f9fa;
                    padding:20px;
                    border-radius:8px;
                    margin:20px 0;
                ">

                    <h3 style="margin-top:0; margin-bottom:15px;">
                        Customer Details
                    </h3>

                    <p style="margin:0 0 10px;">
                        <strong>Customer Name:</strong>
                        {{ $order->user->name ?? 'N/A' }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Customer Email:</strong>
                        {{ $order->user->email ?? 'N/A' }}
                    </p>

                    @if(!empty($order->user->phone))

                        <p style="margin:0;">
                            <strong>Customer Phone:</strong>
                            {{ $order->user->phone }}
                        </p>

                    @endif

                </div>


                {{-- Order Details --}}

                <div style="
                    background:#f8f9fa;
                    padding:20px;
                    border-radius:8px;
                    margin:20px 0;
                ">

                    <h3 style="margin-top:0; margin-bottom:15px;">
                        Order Details
                    </h3>

                    <p style="margin:0 0 10px;">
                        <strong>Order ID:</strong>
                        #{{ $order->id }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Order Number:</strong>
                        {{ $order->order_number ?? 'N/A' }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Order Date:</strong>
                        {{ $order->created_at?->format('d M Y, h:i A') }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Order Status:</strong>
                        {{ ucwords(str_replace('_', ' ', $order->order_status ?? 'pending')) }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Payment Method:</strong>
                        {{ strtoupper($order->payment_method ?? 'N/A') }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Payment Status:</strong>

                        <span style="
                            display:inline-block;
                            padding:4px 10px;
                            border-radius:20px;
                            background:#d1e7dd;
                            color:#0f5132;
                            font-size:12px;
                            font-weight:bold;
                        ">
                            {{ ucfirst($order->payment_status ?? 'pending') }}
                        </span>
                    </p>

                    <p style="margin:0;">
                        <strong>Order Total:</strong>

                        <span style="font-size:18px; font-weight:bold;">
                            ₹{{ number_format($order->total ?? 0, 2) }}
                        </span>
                    </p>

                </div>


                {{-- Shipping Address --}}

                <div style="
                    background:#f8f9fa;
                    padding:20px;
                    border-radius:8px;
                    margin:20px 0;
                ">

                    <h3 style="margin-top:0; margin-bottom:15px;">
                        Shipping Address
                    </h3>

                    <p style="margin:0 0 5px;">
                        {{ $order->shipping_address ?? 'N/A' }}
                    </p>

                    <p style="margin:0 0 5px;">
                        {{ $order->shipping_city ?? '' }}
                        @if(!empty($order->shipping_state))
                            , {{ $order->shipping_state }}
                        @endif
                    </p>

                    <p style="margin:0 0 5px;">
                        {{ $order->shipping_country ?? '' }}
                    </p>

                    @if(!empty($order->shipping_pincode))

                        <p style="margin:0;">
                            <strong>PIN:</strong>
                            {{ $order->shipping_pincode }}
                        </p>

                    @endif

                </div>


                {{-- Order Items --}}

                <h3 style="margin-top:25px;">
                    Order Items
                </h3>

                <table
                    width="100%"
                    cellpadding="10"
                    cellspacing="0"
                    style="
                        border-collapse:collapse;
                        border:1px solid #eeeeee;
                    "
                >

                    <thead>

                        <tr style="background:#f8f9fa;">

                            <th
                                align="left"
                                style="border-bottom:1px solid #eeeeee;"
                            >
                                Product
                            </th>

                            <th
                                align="center"
                                style="border-bottom:1px solid #eeeeee;"
                            >
                                Qty
                            </th>

                            <th
                                align="right"
                                style="border-bottom:1px solid #eeeeee;"
                            >
                                Price
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($order->items as $item)

                            <tr style="border-top:1px solid #eeeeee;">

                                <td>
                                    {{ $item->product->name ?? $item->product_name ?? 'Product' }}
                                </td>

                                <td align="center">
                                    {{ $item->quantity }}
                                </td>

                                <td align="right">
                                    ₹{{ number_format($item->total ?? (($item->price ?? 0) * ($item->quantity ?? 1)), 2) }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>


                {{-- Admin Action Message --}}

                <div style="
                    margin-top:25px;
                    padding:15px;
                    background:#e7f1ff;
                    border-left:4px solid #0d6efd;
                    border-radius:5px;
                ">

                    <strong>Action Required:</strong>

                    <p style="margin:8px 0 0;">
                        Please login to the admin panel to review and manage
                        this order.
                    </p>

                </div>


            @else

                {{-- ================================================= --}}
                {{-- CUSTOMER EMAIL --}}
                {{-- ================================================= --}}

                <h2 style="margin-top:0;">
                    Hello {{ $order->user->name ?? 'Customer' }},
                </h2>

                <p>
                    Thank you for shopping with us!
                    Your order has been placed successfully.
                </p>


                {{-- Order Details --}}

                <div style="
                    background:#f8f9fa;
                    padding:20px;
                    border-radius:8px;
                    margin:20px 0;
                ">

                    <p style="margin:0 0 10px;">
                        <strong>Order ID:</strong>
                        #{{ $order->id }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Order Date:</strong>
                        {{ $order->created_at?->format('d M Y, h:i A') }}
                    </p>

                    <p style="margin:0 0 10px;">
                        <strong>Payment Status:</strong>
                        {{ ucfirst($order->payment_status ?? 'pending') }}
                    </p>

                    <p style="margin:0;">
                        <strong>Order Total:</strong>
                        ₹{{ number_format($order->total ?? 0, 2) }}
                    </p>

                </div>


                {{-- Order Items --}}

                <h3>
                    Order Items
                </h3>

                <table
                    width="100%"
                    cellpadding="10"
                    cellspacing="0"
                    style="
                        border-collapse:collapse;
                        border:1px solid #eeeeee;
                    "
                >

                    <thead>

                        <tr style="background:#f8f9fa;">

                            <th
                                align="left"
                                style="border-bottom:1px solid #eeeeee;"
                            >
                                Product
                            </th>

                            <th
                                align="center"
                                style="border-bottom:1px solid #eeeeee;"
                            >
                                Qty
                            </th>

                            <th
                                align="right"
                                style="border-bottom:1px solid #eeeeee;"
                            >
                                Price
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($order->items as $item)

                            <tr style="border-top:1px solid #eeeeee;">

                                <td>
                                    {{ $item->product->name ?? $item->product_name ?? 'Product' }}
                                </td>

                                <td align="center">
                                    {{ $item->quantity }}
                                </td>

                                <td align="right">
                                    ₹{{ number_format($item->total ?? (($item->price ?? 0) * ($item->quantity ?? 1)), 2) }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>


                <p style="margin-top:25px;">
                    We will notify you once your order status is updated.
                </p>

                <p>
                    Thank you,<br>
                    <strong>{{ config('app.name') }}</strong>
                </p>

            @endif

        </div>


        {{-- ========================================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================================= --}}

        <div style="
            padding:15px;
            text-align:center;
            background:#f8f9fa;
            color:#888888;
            font-size:12px;
        ">

            © {{ date('Y') }}
            {{ config('app.name') }}.
            All rights reserved.

        </div>

    </div>

</body>
</html>
