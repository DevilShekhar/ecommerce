@can('warehouses.show')
@extends('layouts.app')

@section('title', 'Warehouse Details')

@section('content')

<section class="content">
    <div class="body_scroll">

        <!-- Block Header -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Warehouse Details</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('warehouses.index') }}">
                                Warehouses
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Warehouse Details
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-warning">
                        <i class="zmdi zmdi-edit"></i> Edit Warehouse
                    </a>
                    <a href="{{ route('warehouses.index') }}" class="btn btn-primary btn-round">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row clearfix">
                
                <!-- Main Warehouse Info Card -->
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Basic</strong> Information</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Warehouse Code</small>
                                    <p class="font-weight-bold text-primary mb-0">{{ $warehouse->warehouse_code }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Warehouse Name</small>
                                    <p class="font-weight-bold mb-0">{{ $warehouse->warehouse_name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Associated Branch</small>
                                    <p class="mb-0">{{ $warehouse->branch->name ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Capacity</small>
                                    <p class="mb-0">{{ $warehouse->capacity ? number_format($warehouse->capacity) : 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Status</small>
                                    <p class="mb-0">
                                        @if($warehouse->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <small class="text-muted">Created At</small>
                                    <p class="mb-0">{{ $warehouse->created_at ? $warehouse->created_at->format('d M Y, h:i A') : '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address & Location Card -->
                    <div class="card">
                        <div class="header">
                            <h2><strong>Location</strong> & Address Details</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <small class="text-muted">Full Address</small>
                                    <p class="mb-0">{{ $warehouse->address ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <small class="text-muted">City</small>
                                    <p class="mb-0">{{ $warehouse->city ?? '-' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <small class="text-muted">State</small>
                                    <p class="mb-0">{{ $warehouse->state ?? '-' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <small class="text-muted">Country</small>
                                    <p class="mb-0">{{ $warehouse->country ?? '-' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <small class="text-muted">Pincode</small>
                                    <p class="mb-0">{{ $warehouse->pincode ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact & Info Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Contact</strong> Information</h2>
                        </div>
                        <div class="body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <small class="text-muted d-block">Phone Number</small>
                                    <i class="zmdi zmdi-phone mr-2 text-primary"></i>
                                    <span>{{ $warehouse->phone ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-3">
                                    <small class="text-muted d-block">Email Address</small>
                                    <i class="zmdi zmdi-email mr-2 text-primary"></i>
                                    <span>{{ $warehouse->email ?? 'N/A' }}</span>
                                </li>
                                <li>
                                    <small class="text-muted d-block">Last Updated</small>
                                    <i class="zmdi zmdi-time mr-2 text-primary"></i>
                                    <span>{{ $warehouse->updated_at ? $warehouse->updated_at->diffForHumans() : '-' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

@endsection
@else
    @php
        abort(403);
    @endphp
@endcan