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
                            <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
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
                                <th>Tag</th>
                                <th>Meta Details</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th width="140">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    
                                    <!-- Primary Image Thumbnail -->
                                    <td>
                                        @if($product->image)
                                            @php $images = explode(',', $product->image); @endphp
                                            <img src="{{ asset($images[0]) }}" width="50" height="50" class="rounded" style="object-fit: cover;">
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

                                    <!-- Is Featured / Tag -->
                                    <td>
                                        @if($product->is_featured == 1)
                                            <span class="badge badge-warning">Featured</span>
                                        @elseif($product->is_featured == 2)
                                            <span class="badge badge-info">New</span>
                                        @else
                                            <span class="badge badge-light">Normal</span>
                                        @endif
                                    </td>

                                    <!-- Click-to-Modal Meta Details -->
                                    <td>
                                        <div class="meta-clickable" 
                                             data-title="Meta Information - {{ $product->name }}" 
                                             data-content="Title: {{ $product->meta_title ?? 'N/A' }}\n\nKeywords: {{ $product->meta_keywords ?? 'N/A' }}\n\nDescription/Ads: {{ $product->meta_description ?? 'N/A' }}" 
                                             data-toggle="tooltip" 
                                             title="Click to view full meta details">
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
                                        <!-- View Button -->
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm" title="View Details">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline delete-form">
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
                                    <td colspan="10" class="text-center">No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meta Details Modal -->
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
                <p id="modalFieldContent" style="white-space: pre-wrap; word-break: break-word; font-size: 14px; color: #333;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

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
</style>
@endpush
