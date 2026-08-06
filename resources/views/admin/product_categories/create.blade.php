@extends('layouts.app')

@section('title', 'Create Category')

@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Create Category</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('product_categories.index') }}">Categories</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Create Category
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('product_categories.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
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

            <form method="POST" action="{{ route('product_categories.store') }}">
                @csrf

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Create</strong> Category</h2>
                            </div>

                            <div class="body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Category Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Category Name"
                                                value="{{ old('name') }}"
                                            >

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>

                                            <select
                                                name="status"
                                                class="form-control @error('status') is-invalid @enderror"
                                            >
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>

                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>

                                            <textarea
                                                name="description"
                                                rows="4"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Enter Description"
                                            >{{ old('description') }}</textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
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
                                <a href="{{ route('product_categories.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Create Category
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
