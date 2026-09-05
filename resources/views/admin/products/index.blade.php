@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Products</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Products</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Product
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h2><strong>Product</strong> List</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th width="50">SrNo.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category / Sub Category</th>
                                    <th>Price</th>
                                    <th>Remaining Stock</th>
                                    <th>Tag</th>
                                    <th>Offer</th>
                                    <th>Meta Details</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th width="140">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        {{-- Primary Image Thumbnail --}}
                                        <td>
                                            @if ($product->image)
                                                @php
                                                    $images = explode(',', $product->image);
                                                @endphp
                                                <img src="{{ asset($images[0]) }}" width="50" height="50" class="rounded"
                                                    style="object-fit: cover;">
                                            @else
                                                <span class="badge badge-secondary">No Image</span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong>{{ $product->name }}</strong><br>
                                            <small class="text-muted">SKU: {{ $product->sku }}</small>
                                        </td>

                                        <td>
                                            {{ $product->category->name ?? '-' }} /<br>
                                            <small>{{ $product->subCategory->name ?? '-' }}</small>
                                        </td>

                                        <td>₹{{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock ?? '-' }}</td>

                                        {{-- Is Featured / Tag --}}
                                        <td>
                                            @if ($product->is_featured == 1)
                                                <span class="badge badge-warning">Featured</span>
                                            @elseif ($product->is_featured == 2)
                                                <span class="badge badge-info">New</span>
                                            @else
                                                <span class="badge badge-light">Normal</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($product->activeOffers && $product->activeOffers->count())
                                                @foreach ($product->activeOffers as $offer)
                                                    <span class="badge badge-success">
                                                        {{ $offer->title }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        @if ($offer->discount_type === 'percentage')
                                                            {{ rtrim(rtrim(number_format($offer->discount_value, 2), '0'), '.') }}% OFF
                                                        @else
                                                            ₹{{ number_format($offer->discount_value, 2) }} OFF
                                                        @endif
                                                    </small>
                                                @endforeach
                                            @else
                                                <span class="badge badge-light">No Offer</span>
                                            @endif
                                        </td>

                                        {{-- Click-to-Modal Meta Details --}}
                                        <td>
                                            <div class="meta-clickable" data-title="Meta Information - {{ $product->name }}"
                                                data-content="Title: {{ $product->meta_title ?? 'N/A' }}\n\nKeywords: {{ $product->meta_keywords ?? 'N/A' }}\n\nDescription/Ads: {{ $product->meta_description ?? 'N/A' }}"
                                                data-toggle="tooltip" title="Click to view full meta details">
                                                <span class="text-truncate d-inline-block" style="max-width: 120px;">
                                                    {{ $product->meta_title ?? 'View Meta' }}
                                                </span>
                                            </div>
                                        </td>

                                        <td>{{ $product->creator->name ?? 'System' }}</td>

                                        <td>
                                            <span class="badge {{ $product->status ? 'badge-success' : 'badge-danger' }}">
                                                {{ $product->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{-- Add Stock --}}
                                            <button type="button" class="btn btn-success btn-sm add-stock-btn"
                                                data-toggle="modal" data-target="#addStockModal"
                                                data-product-id="{{ $product->slug }}" data-product-name="{{ $product->name }}"
                                                data-product-sku="{{ $product->sku }}"
                                                data-current-stock="{{ $product->stock ?? 0 }}" title="Add Stock">
                                                <i class="zmdi zmdi-plus"></i>
                                            </button>

                                            <button type="button" class="btn btn-secondary btn-sm inventory-history-btn"
                                                data-toggle="modal" data-target="#inventoryHistoryModal"
                                                data-product-name="{{ $product->name }}" data-product-sku="{{ $product->sku }}"
                                                data-current-stock="{{ $product->stock ?? 0 }}"
                                                data-history='@json($product->inventoryTransactions->sortByDesc("created_at")->values())'
                                                title="Inventory History">
                                                <i class="zmdi zmdi-time-restore"></i>
                                            </button>

                                            {{-- View --}}
                                            <a href="{{ route('product.details', ['slug' => $product->slug]) }}"
                                                class="btn btn-info btn-sm" title="View Details">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.products.edit', ['product' => $product->slug]) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Meta Details Modal --}}
    <div class="modal fade" id="metaViewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalFieldTitle">Meta Information</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalFieldContent"
                        style="white-space: pre-wrap; word-break: break-word; font-size: 14px; color: #333;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Stock Modal --}}
    <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addStockModalLabel">
                        <i class="zmdi zmdi-plus-circle"></i> Add Stock
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="addStockForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        {{-- Product --}}
                        <div class="product-stock-info mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 id="stockProductName" class="mb-1">Product Name</h5>
                                    <small class="text-muted">
                                        SKU: <span id="stockProductSku">-</span>
                                    </small>
                                </div>
                                <div class="text-right">
                                    <small class="text-muted d-block">Current Stock</small>
                                    <strong id="currentStock" class="text-success" style="font-size: 22px;">0</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Quantity --}}
                        <div class="form-group">
                            <label>
                                Stock Quantity <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="quantity" id="stockQuantity" class="form-control" min="1" step="1"
                                placeholder="Enter quantity" required>
                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Supplier --}}
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <input type="text" name="supplier_name" class="form-control" placeholder="Enter supplier name">
                        </div>

                        {{-- Invoice --}}
                        <div class="form-group">
                            <label>Invoice / Purchase Reference</label>
                            <input type="text" name="invoice_number" class="form-control" placeholder="e.g. INV-2026-001">
                        </div>

                        {{-- Notes --}}
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3"
                                placeholder="Optional stock notes"></textarea>
                        </div>

                        {{-- Preview --}}
                        <div class="stock-preview">
                            <div class="d-flex justify-content-between">
                                <span>Current Stock</span>
                                <strong id="previewCurrentStock">0</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Stock To Add</span>
                                <strong id="previewStockAdd">0</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>New Stock</strong>
                                <strong class="text-success" id="previewNewStock">0</strong>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-success btn-round">
                            <i class="zmdi zmdi-plus"></i> Add Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Inventory History Modal --}}
    <div class="modal fade" id="inventoryHistoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <div>
                        <h5 class="modal-title mb-1">
                            <i class="zmdi zmdi-time-restore"></i> Inventory History
                        </h5>
                        <small id="historyProductInfo">Product</small>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{-- Product Summary --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="inventory-summary-card">
                                <small>Product</small>
                                <strong id="historyProductName">-</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inventory-summary-card">
                                <small>SKU</small>
                                <strong id="historyProductSku">-</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inventory-summary-card">
                                <small>Current Stock</small>
                                <strong class="text-success" id="historyCurrentStock">0</strong>
                            </div>
                        </div>
                    </div>

                    {{-- History Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Stock Before</th>
                                    <th>Stock After</th>
                                    <th>Added By</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryHistoryBody"></tbody>
                        </table>
                    </div>

                    <div id="noInventoryHistory" class="text-center py-4" style="display: none;">
                        <i class="zmdi zmdi-info-outline" style="font-size: 35px;"></i>
                        <p class="mb-0 text-muted">No inventory history found.</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Add Stock Modal
            $('.add-stock-btn').on('click', function () {
                const productId = $(this).data('product-id');
                const productName = $(this).data('product-name');
                const productSku = $(this).data('product-sku');
                const currentStock = parseInt($(this).data('current-stock')) || 0;

                // Set product information
                $('#stockProductName').text(productName);
                $('#stockProductSku').text(productSku);
                $('#currentStock').text(currentStock);
                $('#previewCurrentStock').text(currentStock);

                // Reset quantity
                $('#stockQuantity').val('');
                $('#previewStockAdd').text('0');
                $('#previewNewStock').text(currentStock);

                // Set form action dynamically
                $('#addStockForm').attr(
                    'action',
                    '{{ url("/products") }}/' + productId + '/add-stock'
                );
            });

            // Live stock calculation
            $('#stockQuantity').on('input', function () {
                const currentStock = parseInt($('#previewCurrentStock').text()) || 0;
                const quantity = parseInt($(this).val()) || 0;
                const newStock = currentStock + quantity;

                $('#previewStockAdd').text(quantity);
                $('#previewNewStock').text(newStock);
            });

            // Inventory History Modal
            $('.inventory-history-btn').on('click', function () {
                const productName = $(this).data('product-name');
                const productSku = $(this).data('product-sku');
                const currentStock = $(this).data('current-stock');
                const history = $(this).data('history') || [];

                $('#historyProductName').text(productName);
                $('#historyProductSku').text(productSku);
                $('#historyCurrentStock').text(currentStock);
                $('#historyProductInfo').text(productName + ' | SKU: ' + productSku);

                const tbody = $('#inventoryHistoryBody');
                tbody.empty();

                if (!history.length) {
                    $('#noInventoryHistory').show();
                    return;
                }

                $('#noInventoryHistory').hide();

                history.forEach(function (item, index) {
                    const isStockIn = item.type === 'stock_in';

                    const typeBadge = isStockIn
                        ? '<span class="badge badge-success">Stock In</span>'
                        : '<span class="badge badge-danger">Stock Out</span>';

                    const quantity = isStockIn
                        ? '+' + item.quantity
                        : '-' + item.quantity;

                    const quantityClass = isStockIn
                        ? 'text-success'
                        : 'text-danger';

                    const date = item.created_at
                        ? new Date(item.created_at).toLocaleString('en-IN')
                        : '-';

                    const creator = item.creator
                        ? item.creator.name
                        : 'System';

                    tbody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${date}</td>
                                <td>${typeBadge}</td>
                                <td>
                                    <strong class="${quantityClass}">
                                        ${quantity}
                                    </strong>
                                </td>
                                <td>${item.stock_before}</td>
                                <td>
                                    <strong>${item.stock_after}</strong>
                                </td>
                                <td>${creator}</td>
                                <td>${item.notes ?? '-'}</td>
                            </tr>
                        `);
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .meta-clickable {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline dotted;
        }

        .meta-clickable:hover {
            color: #0056b3;
        }

        .product-stock-info {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 15px;
        }

        .stock-preview {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 15px;
            color: #334155;
        }

        .stock-preview hr {
            border-color: #bbf7d0;
            margin: 10px 0;
        }

        .add-stock-btn {
            min-width: 34px;
        }
    </style>
@endpush
