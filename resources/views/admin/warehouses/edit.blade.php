@extends('layouts.app')

@section('title', 'Edit Warehouse')

@section('content')

<section class="content">
    <div class="body_scroll">

        <!-- Block Header -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Edit Warehouse</h2>

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
                            Edit Warehouse
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('warehouses.index') }}"
                        class="btn btn-primary btn-round">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <div class="card">

                <div class="header">
                    <h2>Edit Warehouse</h2>
                </div>

                <div class="body">

                    <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- Warehouse Code -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>
                                    Warehouse Code
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="warehouse_code"
                                    class="form-control @error('warehouse_code') is-invalid @enderror"
                                    value="{{ old('warehouse_code', $warehouse->warehouse_code) }}"
                                    placeholder="Enter Warehouse Code">

                                @error('warehouse_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Warehouse Name -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>
                                    Warehouse Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="warehouse_name"
                                    class="form-control @error('warehouse_name') is-invalid @enderror"
                                    value="{{ old('warehouse_name', $warehouse->warehouse_name) }}"
                                    placeholder="Enter Warehouse Name">

                                @error('warehouse_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Branch -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>
                                    Branch
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="branch_id"
                                    class="form-control @error('branch_id') is-invalid @enderror">

                                    <option value="">Select Branch</option>

                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ old('branch_id', $warehouse->branch_id) == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('branch_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>
                                    Phone
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $warehouse->phone) }}"
                                    placeholder="Enter Phone Number">

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>Email</label>

                                <input type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $warehouse->email) }}"
                                    placeholder="Enter Email">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Capacity -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>Capacity</label>

                                <input type="number"
                                    name="capacity"
                                    class="form-control @error('capacity') is-invalid @enderror"
                                    value="{{ old('capacity', $warehouse->capacity) }}"
                                    placeholder="Enter Capacity">

                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>
                                    Status
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="status"
                                    class="form-control @error('status') is-invalid @enderror">

                                    <option value="1" {{ old('status', $warehouse->status) == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ old('status', $warehouse->status) == '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-lg-12 mb-3">
                                <label>
                                    Address
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter Address">{{ old('address', $warehouse->address) }}</textarea>

                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-lg-4 col-md-4 mb-3">
                                <label>
                                    City
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="city"
                                    class="form-control @error('city') is-invalid @enderror"
                                    value="{{ old('city', $warehouse->city) }}"
                                    placeholder="Enter City">

                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-lg-4 col-md-4 mb-3">
                                <label>
                                    State
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="state"
                                    class="form-control @error('state') is-invalid @enderror"
                                    value="{{ old('state', $warehouse->state) }}"
                                    placeholder="Enter State">

                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="col-lg-4 col-md-4 mb-3">
                                <label>
                                    Country
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="country"
                                    class="form-control @error('country') is-invalid @enderror"
                                    value="{{ old('country', $warehouse->country) }}"
                                    placeholder="Enter Country">

                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pincode -->
                            <div class="col-lg-6 col-md-6 mb-3">
                                <label>
                                    Pincode
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="pincode"
                                    class="form-control @error('pincode') is-invalid @enderror"
                                    value="{{ old('pincode', $warehouse->pincode) }}"
                                    placeholder="Enter Pincode">

                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <hr>

                        <div class="text-right">

                            <button type="submit"
                                class="btn btn-primary">
                                <i class="zmdi zmdi-save"></i>
                                Update Warehouse
                            </button>

                            <a href="{{ route('warehouses.index') }}"
                                class="btn btn-danger">
                                <i class="zmdi zmdi-close"></i>
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection