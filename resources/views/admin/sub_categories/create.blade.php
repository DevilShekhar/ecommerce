@can('sub_categories-create')
@extends('layouts.app')

@section('title', 'Create Sub Category')

@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Create Sub Category</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('sub_categories.index') }}">
                                Sub Categories
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Create Sub Category
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('sub_categories.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <form method="POST" action="{{ route('sub_categories.store') }}">
                @csrf

                <div class="row clearfix">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Create</strong> Sub Category</h2>
                            </div>

                            <div class="body">
                                <div class="row">

                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Category
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror"
                                            >
                                                <option value="">-- Select Category --</option>

                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                    >
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <span class="invalid-feedback d-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Sub Category Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Sub Category Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Sub Category Name"
                                                value="{{ old('name') }}"
                                            >

                                            @error('name')
                                                <span class="invalid-feedback d-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Title -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <input
                                                type="text"
                                                name="meta_title"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                placeholder="Enter Meta Title"
                                                value="{{ old('meta_title') }}"
                                            >
                                            @error('meta_title')
                                                <span class="invalid-feedback d-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <textarea
                                                name="meta_keywords"
                                                class="form-control @error('meta_keywords') is-invalid @enderror"
                                                rows="2"
                                                placeholder="Enter Meta Keywords (separated by commas)"
                                            >{{ old('meta_keywords') }}</textarea>
                                            @error('meta_keywords')
                                                <span class="invalid-feedback d-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea
                                                name="meta_description"
                                                class="form-control @error('meta_description') is-invalid @enderror"
                                                rows="3"
                                                placeholder="Enter Meta Description"
                                            >{{ old('meta_description') }}</textarea>
                                            @error('meta_description')
                                                <span class="invalid-feedback d-block">
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

                                <a href="{{ route('sub_categories.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Create Sub Category
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
@else
    @php
        abort(403);
    @endphp
@endcan
