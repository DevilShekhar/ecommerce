@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Product Details</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.products.index') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $product->name }}</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.products.edit', ['product' => $product->slug]) }}"
                            class="btn btn-warning btn-sm" title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                        </a>

                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row clearfix">

                    <!-- Left Column: Product Images & Core Status -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Product</strong> Images</h2>
                            </div>
                            <div class="body text-center">
                                @if($product->image)
                                    @php $images = explode(',', $product->image); @endphp
                                    <!-- Main Image -->
                                    <div class="mb-3">
                                        <img id="mainProductImage" src="{{ asset($images[0]) }}"
                                            class="img-fluid rounded border p-1"
                                            style="max-height: 280px; object-fit: contain;">
                                    </div>
                                    <!-- Thumbnail Gallery -->
                                    <div class="d-flex flex-wrap justify-content-center">
                                        @foreach($images as $imgPath)
                                            <img src="{{ asset($imgPath) }}" width="60" height="60"
                                                class="img-thumbnail m-1 thumb-image" style="cursor: pointer; object-fit: cover;"
                                                onclick="document.getElementById('mainProductImage').src='{{ asset($imgPath) }}'">
                                        @endforeach
                                    </div>
                                @else
                                    <div class="p-4 border rounded bg-light">
                                        <i class="zmdi zmdi-image-alt text-muted" style="font-size: 48px;"></i>
                                        <p class="mb-0 text-muted mt-2">No Images Uploaded</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Details Card -->
                        <div class="card">
                            <div class="header">
                                <h2><strong>Quick</strong> Summary</h2>
                            </div>
                            <div class="body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Status</strong>
                                        <span class="badge {{ $product->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $product->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Product Tag</strong>
                                        @if($product->is_featured == 1)
                                            <span class="badge badge-warning">Featured</span>
                                        @elseif($product->is_featured == 2)
                                            <span class="badge badge-info">New</span>
                                        @else
                                            <span class="badge badge-light">Normal</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Selling Price</strong>
                                        <span class="text-primary font-weight-bold"
                                            style="font-size: 16px;">₹{{ number_format($product->selling_price, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Price</strong>
                                        <span class="text-success font-weight-bold"
                                            style="font-size: 16px;">₹{{ number_format($product->price, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Stock</strong>
                                        <span class="badge badge-primary">{{ $product->stock }} Units</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>SKU</strong>
                                        <code>{{ $product->sku }}</code>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Full Details -->
                    <div class="col-lg-8 col-md-12">

                        <!-- General Details -->
                        <div class="card">
                            <div class="header">
                                <h2><strong>General</strong> Information</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <th width="30%">Product Name</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub Category</th>
                                        <td>{{ $product->subCategory->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Brand</th>
                                        <td>{{ $product->brand->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Variants</th>
                                        <td>{{ $product->variants ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Specification -->
                        <div class="card">
                            <div class="header">
                                <h2><strong>Specification</strong></h2>
                            </div>
                            <div class="body">
                                <p style="white-space: pre-wrap; word-break: break-word;" class="mb-0">
                                    {!! $product->specification ?? '<p>No specification added.</p>' !!}
                                </p>
                            </div>
                        </div>

                        <!-- SEO Meta Information -->
                        <div class="card">
                            <div class="header">
                                <h2><strong>SEO Meta</strong> Details</h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <th width="30%">Meta Title</th>
                                        <td>{{ $product->meta_title ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Keywords</th>
                                        <td>{{ $product->meta_keywords ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Description / Meta Ads</th>
                                        <td style="white-space: pre-wrap;">{{ $product->meta_description ?? 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- User Tracking Information -->
                        <div class="card">
                            <div class="header">
                                <h2><strong>Audit</strong> Information</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Created By:</strong>
                                            {{ $product->creator->name ?? 'System' }}</p>
                                        <p class="mb-0 text-muted"><small>Date:
                                                {{ $product->created_at ? $product->created_at->format('d M, Y h:i A') : 'N/A' }}</small>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Last Updated By:</strong>
                                            {{ $product->updater->name ?? 'System' }}</p>
                                        <p class="mb-0 text-muted"><small>Date:
                                                {{ $product->updated_at ? $product->updated_at->format('d M, Y h:i A') : 'N/A' }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
