@extends('layouts.app')

@section('title', 'Create Warehouse')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Create Warehouse</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('warehouses.index') }}">Warehouses</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Create Warehouse
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('warehouses.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('warehouses.store') }}">
                @csrf

                <div class="row clearfix">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Create</strong> Warehouse</h2>
                            </div>

                            <div class="body">

                                <div class="row">

                                    <!-- Warehouse Code -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Warehouse Code
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                name="warehouse_code"
                                                class="form-control @error('warehouse_code') is-invalid @enderror"
                                                placeholder="Enter Warehouse Code"
                                                value="{{ old('warehouse_code') }}">

                                            @error('warehouse_code')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Warehouse Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Warehouse Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                name="warehouse_name"
                                                class="form-control @error('warehouse_name') is-invalid @enderror"
                                                placeholder="Enter Warehouse Name"
                                                value="{{ old('warehouse_name') }}">

                                            @error('warehouse_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Branch -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Branch
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select name="branch_id"
                                                class="form-control @error('branch_id') is-invalid @enderror">
                                                <option value="">-- Select Branch --</option>

                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('branch_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Phone
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Enter Phone Number"
                                                value="{{ old('phone') }}">

                                            @error('phone')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>

                                            <input type="email"
                                                name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter Email Address"
                                                value="{{ old('email') }}">

                                            @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Capacity -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capacity</label>

                                            <input type="number"
                                                name="capacity"
                                                class="form-control @error('capacity') is-invalid @enderror"
                                                placeholder="Enter Warehouse Capacity"
                                                value="{{ old('capacity') }}">

                                            @error('capacity')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                Address
                                                <span class="text-danger">*</span>
                                            </label>

                                            <textarea
                                                name="address"
                                                rows="3"
                                                class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Enter Complete Address">{{ old('address') }}</textarea>

                                            @error('address')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City <span class="text-danger">*</span></label>

                                            <input type="text"
                                                name="city"
                                                class="form-control @error('city') is-invalid @enderror"
                                                placeholder="Enter City"
                                                value="{{ old('city') }}">

                                            @error('city')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="text-danger">*</span></label>

                                            <input type="text"
                                                name="state"
                                                class="form-control @error('state') is-invalid @enderror"
                                                placeholder="Enter State"
                                                value="{{ old('state') }}">

                                            @error('state')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country <span class="text-danger">*</span></label>

                                            <input type="text"
                                                name="country"
                                                class="form-control @error('country') is-invalid @enderror"
                                                placeholder="Enter Country"
                                                value="{{ old('country','India') }}">

                                            @error('country')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pincode -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pincode <span class="text-danger">*</span></label>

                                            <input type="text"
                                                name="pincode"
                                                class="form-control @error('pincode') is-invalid @enderror"
                                                placeholder="Enter Pincode"
                                                value="{{ old('pincode') }}">

                                            @error('pincode')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>

                                            <select name="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" {{ old('status',1)==1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ old('status')=='0' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>

                                            @error('status')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Create Warehouse
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>
</section>

@endsection
