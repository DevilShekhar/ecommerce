@extends('layouts.app')

@section('title', 'Create Brand')

@section('content')

    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Create Brand</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('brands.index') }}"> Brands </a>
                            </li>

                            <li class="breadcrumb-item active">Create Brand</li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('brands.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <form id="brand-create-form" method="POST" action="{{ route('brands.store') }}">
                    @csrf

                    <div class="row clearfix">

                        <div class="col-lg-12">
                            <div class="card">

                                <div class="header">
                                    <h2><strong>Create</strong> Brand</h2>
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

                                                <select name="category_id" id="category_id"
                                                    class="form-control @error('category_id') is-invalid @enderror">
                                                    <option value="">Select Category</option>

                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('category_id')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Sub Category -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Sub Category
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select name="sub_category_id" id="sub_category_id"
                                                    class="form-control @error('sub_category_id') is-invalid @enderror">
                                                    <option value="">Select Sub Category</option>
                                                </select>

                                                @error('sub_category_id')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Brand Code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Brand Code
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="brand_code"
                                                    class="form-control @error('brand_code') is-invalid @enderror"
                                                    placeholder="Enter Brand Code"
                                                    value="{{ old('brand_code') }}"
                                                >

                                                @error('brand_code')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Brand Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Brand Name
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Enter Brand Name"
                                                    value="{{ old('name') }}"
                                                >

                                                @error('name')
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

                        <div class="col-md-12">
                            <div class="card mt-3">
                                <div class="header">
                                    <h2><strong>SEO</strong> Details</h2>
                                </div>

                                <div class="body">
                                    <div class="row">

                                        <!-- Meta Title -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Title</label>

                                                <input type="text" name="meta_title"
                                                    class="form-control @error('meta_title') is-invalid @enderror"
                                                    placeholder="Enter Meta Title"
                                                    value="{{ old('meta_title') }}">

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
                                                <label>Meta Keywords</label>

                                                <textarea name="meta_keyword" rows="3"
                                                    class="form-control @error('meta_keyword') is-invalid @enderror"
                                                    placeholder="Example: electronics, mobiles, accessories">{{ old('meta_keyword') }}</textarea>

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
                                                <label>Meta Description</label>

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

                        <!-- Buttons -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body text-right">

                                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>

                                    <button type="submit" class="btn btn-success">
                                        <i class="zmdi zmdi-save"></i>
                                        Create Brand
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
@section('scripts')

    <script>
        $(document).ready(function () {

            $('#category_id').change(function () {

                let categoryId = $(this).val();

                if (categoryId == '') {
                    $('#sub_category_id').html('<option value="">Select Sub Category</option>');
                    return;
                }

                $.ajax({
                    url: "{{ url('get-subcategories') }}/" + categoryId,
                    type: "GET",
                    dataType: "json",

                    success: function (response) {

                        let html = '<option value="">Select Sub Category</option>';

                        $.each(response, function (index, item) {

                            html += '<option value="' + item.id + '">' + item.name + '</option>';

                        });

                        $('#sub_category_id').html(html);

                        // If your theme uses bootstrap-select
                        if ($.fn.selectpicker) {
                            $('#sub_category_id').selectpicker('refresh');
                        }
                    },

                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }

                });

            });

        });
    </script>

@endsection
