@extends('layouts.app')

@section('title', 'Top Rated Products')

@section('content')

    <section class="content">
        <div class="body_scroll">

            {{-- ==============================
            PAGE HEADER
            =============================== --}}
            <div class="block-header">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <h2>Top Rated Products</h2>

                        <ul class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Top Rated Products
                            </li>

                        </ul>

                    </div>

                </div>
            </div>


            {{-- ==============================
            PRODUCT LIST
            =============================== --}}
            <div class="container-fluid">

                <div class="card">

                    <div class="header">

                        <h2>
                            <strong>Top Rated</strong> Products
                        </h2>

                    </div>

                    <div class="body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                <thead>
                                    <tr>

                                        <th width="60">
                                            SrNo.
                                        </th>

                                        <th>
                                            Product
                                        </th>

                                        <th>
                                            SKU
                                        </th>

                                        <th>
                                            Price
                                        </th>

                                        <th>
                                            Rating
                                        </th>

                                        <th>
                                            Reviews
                                        </th>

                                        <th width="120">
                                            Status
                                        </th>

                                    </tr>
                                </thead>


                                <tbody>

                                    @forelse($topRatedProducts as $key => $product)

                                        <tr>

                                            {{-- Sr No --}}
                                            <td>
                                                {{ $key + 1 }}
                                            </td>


                                            {{-- Product --}}
                                            <td>

                                                <div class="product-table-info">

                                                    @php

                                                        $images = $product->image
                                                            ? array_map('trim', explode(',', $product->image))
                                                            : [];

                                                        $firstImage = $images[0] ?? null;

                                                        if ($firstImage) {

                                                            $firstImage = preg_replace(
                                                                '#^storage/#',
                                                                '',
                                                                $firstImage
                                                            );

                                                            $imgUrl = asset(
                                                                'storage/' . $firstImage
                                                            );

                                                        } else {

                                                            $imgUrl = null;

                                                        }

                                                    @endphp


                                                    @if($imgUrl)

                                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                                            class="product-table-img"
                                                            style="width:50px;height:50px;object-fit:cover;border-radius:6px;"
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                                        <div class="product-table-placeholder"
                                                            style="display:none;width:50px;height:50px;align-items:center;justify-content:center;">
                                                            <i class="zmdi zmdi-image"></i>
                                                        </div>

                                                    @else

                                                        <div class="product-table-placeholder"
                                                            style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;">

                                                            <i class="zmdi zmdi-image"></i>

                                                        </div>

                                                    @endif


                                                    <div class="product-table-details">

                                                        <strong>
                                                            {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                                                        </strong>

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- SKU --}}
                                            <td>
                                                {{ $product->sku ?? '-' }}
                                            </td>


                                            {{-- Price --}}
                                            <td>
                                                ₹{{ number_format($product->price ?? 0, 2) }}
                                            </td>


                                            {{-- Rating --}}
                                            <td>

                                                <span class="rating-badge">

                                                    <i class="zmdi zmdi-star"></i>

                                                    {{ number_format($product->ratings_avg_rating ?? 0, 1) }}

                                                </span>

                                            </td>


                                            {{-- Reviews --}}
                                            <td>

                                                {{ $product->ratings_count ?? 0 }}

                                            </td>


                                            {{-- Status --}}
                                            <td>

                                                @if($product->status)

                                                    <span class="badge badge-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge badge-danger">
                                                        Inactive
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="7" class="text-center">

                                                No top rated products found.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection


@push('scripts')

    <script>
        $(document).ready(function () {

            $('[data-toggle="tooltip"]').tooltip();

        });
    </script>

@endpush
