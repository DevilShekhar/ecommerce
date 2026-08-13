@extends('layouts.app')

@section('title', 'Edit Banner')

@section('content')

<section class="content">
    <div class="body_scroll">

        {{-- Header --}}
        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <h2>Edit Banner</h2>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.banners.index') }}">
                                Banners
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Banner
                        </li>

                    </ul>

                </div>


                <div class="col-lg-6 col-md-6 col-sm-12 text-right">

                    <a href="{{ route('admin.banners.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
                    </a>

                </div>

            </div>
        </div>


        <div class="container-fluid">

            <form
                id="banner-edit-form"
                method="POST"
                action="{{ route('admin.banners.update', $banner->id) }}"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="row clearfix">

                    {{-- Banner Details --}}
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Edit</strong> Banner
                                </h2>
                            </div>


                            <div class="body">

                                <div class="row">

                                    {{-- Title --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Title
                                            </label>

                                            <input
                                                type="text"
                                                name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter Banner Title"
                                                value="{{ old('title', $banner->title) }}"
                                            >

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Banner Type --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Banner Type
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="banner_type"
                                                id="banner_type"
                                                class="form-control @error('banner_type') is-invalid @enderror"
                                            >

                                                <option value="">
                                                    Select Banner Type
                                                </option>

                                                <option
                                                    value="homepage_slider"
                                                    {{ old('banner_type', $banner->banner_type) == 'homepage_slider' ? 'selected' : '' }}
                                                >
                                                    Homepage Slider
                                                </option>

                                                <option
                                                    value="promotional"
                                                    {{ old('banner_type', $banner->banner_type) == 'promotional' ? 'selected' : '' }}
                                                >
                                                    Promotional Banner
                                                </option>

                                                <option
                                                    value="category"
                                                    {{ old('banner_type', $banner->banner_type) == 'category' ? 'selected' : '' }}
                                                >
                                                    Category Banner
                                                </option>

                                                <option
                                                    value="festival"
                                                    {{ old('banner_type', $banner->banner_type) == 'festival' ? 'selected' : '' }}
                                                >
                                                    Festival Banner
                                                </option>

                                                <option
                                                    value="popup"
                                                    {{ old('banner_type', $banner->banner_type) == 'popup' ? 'selected' : '' }}
                                                >
                                                    Popup Banner
                                                </option>

                                                <option
                                                    value="mobile"
                                                    {{ old('banner_type', $banner->banner_type) == 'mobile' ? 'selected' : '' }}
                                                >
                                                    Mobile Banner
                                                </option>

                                            </select>

                                            @error('banner_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Banner Image --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Banner Image
                                            </label>

                                            <input
                                                type="file"
                                                name="image"
                                                id="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                accept="image/*"
                                            >

                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Image Preview --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Image Preview
                                            </label>

                                            <div>

                                                @if($banner->image)

                                                    <img
                                                        id="imagePreview"
                                                        src="{{ asset('storage/' . $banner->image) }}"
                                                        alt="{{ $banner->title }}"
                                                        style="max-width: 250px; max-height: 120px;"
                                                    >

                                                @else

                                                    <img
                                                        id="imagePreview"
                                                        src=""
                                                        alt="Banner Preview"
                                                        style="display: none; max-width: 250px; max-height: 120px;"
                                                    >

                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    {{-- Banner Category --}}
                                    <div
                                        class="col-md-6"
                                        id="bannerCategoryField"
                                        style="display: none;"
                                    >

                                        <div class="form-group">

                                            <label>
                                                Select Banner Category
                                            </label>

                                            <select
                                                name="category_id"
                                                id="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror"
                                            >

                                                <option value="">
                                                    Select Category
                                                </option>

                                                @foreach($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        {{ old('category_id', $banner->category_id) == $category->id ? 'selected' : '' }}
                                                    >
                                                        {{ $category->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Link Type --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Link Type
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="link_type"
                                                id="link_type"
                                                class="form-control @error('link_type') is-invalid @enderror"
                                            >

                                                <option
                                                    value="none"
                                                    {{ old('link_type', $banner->link_type) == 'none' ? 'selected' : '' }}
                                                >
                                                    None
                                                </option>

                                                <option
                                                    value="custom_url"
                                                    {{ old('link_type', $banner->link_type) == 'custom_url' ? 'selected' : '' }}
                                                >
                                                    Custom URL
                                                </option>

                                                <option
                                                    value="product"
                                                    {{ old('link_type', $banner->link_type) == 'product' ? 'selected' : '' }}
                                                >
                                                    Product
                                                </option>

                                                <option
                                                    value="category"
                                                    {{ old('link_type', $banner->link_type) == 'category' ? 'selected' : '' }}
                                                >
                                                    Category
                                                </option>

                                            </select>

                                            @error('link_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Custom URL --}}
                                    <div
                                        class="col-md-6 link-field"
                                        id="customUrlField"
                                        style="display: none;"
                                    >

                                        <div class="form-group">

                                            <label>
                                                Custom URL
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="custom_url"
                                                id="custom_url"
                                                class="form-control"
                                                placeholder="Enter URL"
                                                value="{{ old('link_type', $banner->link_type) == 'custom_url' ? old('link_value', $banner->link_value) : '' }}"
                                            >

                                        </div>

                                    </div>


                                    {{-- Product --}}
                                    <div
                                        class="col-md-6 link-field"
                                        id="productField"
                                        style="display: none;"
                                    >

                                        <div class="form-group">

                                            <label>
                                                Select Product
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="product_id"
                                                id="product_id"
                                                class="form-control"
                                            >

                                                <option value="">
                                                    Select Product
                                                </option>

                                                @foreach($products as $product)

                                                    <option
                                                        value="{{ $product->id }}"
                                                        {{ old('link_type', $banner->link_type) == 'product' && old('link_value', $banner->link_value) == $product->id ? 'selected' : '' }}
                                                    >
                                                        {{ $product->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>


                                    {{-- Link Category --}}
                                    <div
                                        class="col-md-6 link-field"
                                        id="linkCategoryField"
                                        style="display: none;"
                                    >

                                        <div class="form-group">

                                            <label>
                                                Select Category
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="link_category_id"
                                                id="link_category_id"
                                                class="form-control"
                                            >

                                                <option value="">
                                                    Select Category
                                                </option>

                                                @foreach($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        {{ old('link_type', $banner->link_type) == 'category' && old('link_value', $banner->link_value) == $category->id ? 'selected' : '' }}
                                                    >
                                                        {{ $category->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>


                                    {{-- Start Date --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Start Date
                                            </label>

                                            <input
                                                type="date"
                                                name="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date', $banner->start_date ? $banner->start_date->format('Y-m-d') : '') }}"
                                            >

                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- End Date --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                End Date
                                            </label>

                                            <input
                                                type="date"
                                                name="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date', $banner->end_date ? $banner->end_date->format('Y-m-d') : '') }}"
                                            >

                                            @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Sort Order --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Sort Order
                                            </label>

                                            <input
                                                type="number"
                                                name="sort_order"
                                                min="0"
                                                class="form-control @error('sort_order') is-invalid @enderror"
                                                placeholder="Enter Sort Order"
                                                value="{{ old('sort_order', $banner->sort_order) }}"
                                            >

                                            @error('sort_order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Status --}}
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Status
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="status"
                                                class="form-control @error('status') is-invalid @enderror"
                                            >

                                                <option
                                                    value="1"
                                                    {{ old('status', $banner->status) == 1 ? 'selected' : '' }}
                                                >
                                                    Active
                                                </option>

                                                <option
                                                    value="0"
                                                    {{ old('status', $banner->status) == 0 ? 'selected' : '' }}
                                                >
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

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="body text-right">

                                <a
                                    href="{{ route('admin.banners.index') }}"
                                    class="btn btn-secondary"
                                >
                                    Cancel
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >
                                    <i class="zmdi zmdi-save"></i>
                                    Update Banner
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

    /*
    |--------------------------------------------------------------------------
    | Banner Type
    |--------------------------------------------------------------------------
    */

    function changeBannerType()
    {
        var bannerType = $('#banner_type').val();

        if (bannerType === 'category') {

            $('#bannerCategoryField').show();

        } else {

            $('#bannerCategoryField').hide();

        }
    }


    changeBannerType();


    $('#banner_type').on('change', function () {

        changeBannerType();

    });


    /*
    |--------------------------------------------------------------------------
    | Link Type
    |--------------------------------------------------------------------------
    */

    function changeLinkType()
    {
        var linkType = $('#link_type').val();

        // Hide all fields
        $('.link-field').hide();


        // Custom URL
        if (linkType === 'custom_url') {

            $('#customUrlField').show();

        }


        // Product
        if (linkType === 'product') {

            $('#productField').show();

        }


        // Category
        if (linkType === 'category') {

            $('#linkCategoryField').show();

        }
    }


    // Run on page load
    changeLinkType();


    // Run on change
    $('#link_type').on('change', function () {

        changeLinkType();

    });


    /*
    |--------------------------------------------------------------------------
    | Form Submit
    |--------------------------------------------------------------------------
    */

    $('#banner-edit-form').on('submit', function () {

        // Remove old hidden value
        $('#final_link_value').remove();

        var linkType = $('#link_type').val();

        var linkValue = '';


        // Custom URL
        if (linkType === 'custom_url') {

            linkValue = $('#custom_url').val();

        }


        // Product
        if (linkType === 'product') {

            linkValue = $('#product_id').val();

        }


        // Category
        if (linkType === 'category') {

            linkValue = $('#link_category_id').val();

        }


        // Add link_value
        if (linkType !== 'none') {

            $('<input>')
                .attr({
                    type: 'hidden',
                    id: 'final_link_value',
                    name: 'link_value',
                    value: linkValue
                })
                .appendTo(this);

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Image Preview
    |--------------------------------------------------------------------------
    */

    $('#image').on('change', function () {

        var file = this.files[0];

        if (!file) {
            return;
        }


        var reader = new FileReader();


        reader.onload = function (e) {

            $('#imagePreview')
                .attr('src', e.target.result)
                .show();

        };


        reader.readAsDataURL(file);

    });

});

</script>

@endsection
