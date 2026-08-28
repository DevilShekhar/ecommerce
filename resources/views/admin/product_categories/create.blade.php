@can('product_categories-create')

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
                                    <a href="{{ route('product_categories.index') }}">
                                        Categories
                                    </a>
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

                    <form method="POST" action="{{ route('product_categories.store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="row clearfix">

                            <!-- ================= CATEGORY DETAILS ================= -->

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="header">
                                        <h2>
                                            <strong>Create</strong> Category
                                        </h2>
                                    </div>

                                    <div class="body">

                                        <div class="row">

                                            <!-- Category Name -->
                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label>
                                                        Category Name
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Enter Category Name" value="{{ old('name') }}">

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>

                                            </div>


                                            <!-- Category Image -->
                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label>
                                                        Category Image
                                                    </label>

                                                    <input type="file" name="image" id="categoryImage"
                                                        class="form-control @error('image') is-invalid @enderror"
                                                        accept=".jpg,.jpeg,.png,.webp">

                                                    <small class="text-muted">
                                                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                                                    </small>

                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>


                                                <!-- Image Preview -->

                                                <div id="imagePreviewContainer" style="display:none; margin-top:10px;">

                                                    <img id="imagePreview" src="" alt="Category Image Preview" style="
                                                            width:120px;
                                                            height:120px;
                                                            object-fit:cover;
                                                            border-radius:8px;
                                                            border:1px solid #ddd;
                                                            padding:3px;
                                                         ">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- ================= SEO DETAILS ================= -->

                            <div class="col-lg-12">

                                <div class="card mt-3">

                                    <div class="header">

                                        <h2>
                                            <strong>SEO</strong> Details
                                        </h2>

                                    </div>

                                    <div class="body">

                                        <div class="row">

                                            <!-- Meta Title -->
                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label>
                                                        Meta Title
                                                    </label>

                                                    <input type="text" name="meta_title"
                                                        class="form-control @error('meta_title') is-invalid @enderror"
                                                        placeholder="Enter Meta Title" value="{{ old('meta_title') }}">

                                                    @error('meta_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>

                                            </div>


                                            <!-- Meta Keywords -->
                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label>
                                                        Meta Keywords
                                                    </label>

                                                    <textarea name="meta_keyword" rows="3"
                                                        class="form-control @error('meta_keyword') is-invalid @enderror"
                                                        placeholder="Example: gold jewellery, diamond rings, necklaces">{{ old('meta_keyword') }}</textarea>

                                                    @error('meta_keyword')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>

                                            </div>


                                            <!-- Meta Description -->
                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label>
                                                        Meta Description
                                                    </label>

                                                    <textarea name="meta_ads" rows="4"
                                                        class="form-control @error('meta_ads') is-invalid @enderror"
                                                        placeholder="Enter Meta Description">{{ old('meta_ads') }}</textarea>

                                                    @error('meta_ads')
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


                            <!-- ================= BUTTONS ================= -->

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


        <!-- ================= IMAGE PREVIEW ================= -->

        <script>

            document.getElementById('categoryImage').addEventListener('change', function (event) {

                const file = event.target.files[0];

                const previewContainer =
                    document.getElementById('imagePreviewContainer');

                const preview =
                    document.getElementById('imagePreview');

                if (file) {

                    const reader = new FileReader();

                    reader.onload = function (e) {

                        preview.src = e.target.result;

                        previewContainer.style.display = 'block';

                    };

                    reader.readAsDataURL(file);

                } else {

                    preview.src = '';

                    previewContainer.style.display = 'none';

                }

            });

        </script>

    @endsection

@else

@php
    abort(403);
    @endphp

@endcan