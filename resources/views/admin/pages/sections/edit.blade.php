{{-- @can('pages-edit') --}}

@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')

<section class="content">

    <div class="body_scroll">

        <!-- =========================
             PAGE HEADER
        ========================== -->

        <div class="block-header">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <h2>Edit Page Section</h2>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item">

                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i>
                                Dashboard
                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ route('admin.pages.index') }}">
                                Pages
                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ route('admin.pages.sections.index', $page) }}">
                                {{ $page->title }} Sections
                            </a>

                        </li>

                        <li class="breadcrumb-item active">
                            Edit Section
                        </li>

                    </ul>

                </div>


                <div class="col-lg-6 col-md-6 col-sm-12 text-right">

                    <a href="{{ route('admin.pages.sections.index', $page) }}"
                       class="btn btn-danger">

                        <i class="zmdi zmdi-arrow-left"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>


        <!-- =========================
             CONTAINER
        ========================== -->

        <div class="container-fluid">

            <form
                action="{{ route('admin.pages.sections.update', [$page, $section]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                <div class="row clearfix">


                    <!-- =====================================
                         SECTION INFORMATION
                    ====================================== -->

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>Section</strong> Information
                                </h2>

                            </div>


                            <div class="body">

                                <div class="row">


                                    <!-- Section Type -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Section Type
                                                <span class="text-danger">*</span>
                                            </label>


                                            <select
                                                name="section_type"
                                                class="form-control @error('section_type') is-invalid @enderror"
                                                required
                                            >

                                                @foreach([
                                                    'hero',
                                                    'about',
                                                    'services',
                                                    'features',
                                                    'testimonials',
                                                    'faq',
                                                    'cta','products',
                                                ] as $type)

                                                    <option
                                                        value="{{ $type }}"
                                                        {{ old('section_type', $section->section_type) == $type ? 'selected' : '' }}
                                                    >

                                                        {{ ucfirst($type) }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            @error('section_type')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                    <!-- Sort Order -->

                                    <div class="col-md-3">

                                        <div class="form-group">

                                            <label>
                                                Sort Order
                                                <span class="text-danger">*</span>
                                            </label>


                                            <input
                                                type="number"
                                                name="sort_order"
                                                min="1"
                                                class="form-control @error('sort_order') is-invalid @enderror"
                                                value="{{ old('sort_order', $section->sort_order) }}"
                                            >


                                            @error('sort_order')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                    <!-- Status -->

                                    <div class="col-md-3">

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
                                                    {{ old('status', $section->status) == 1 ? 'selected' : '' }}
                                                >
                                                    Active
                                                </option>

                                                <option
                                                    value="0"
                                                    {{ old('status', $section->status) == 0 ? 'selected' : '' }}
                                                >
                                                    Inactive
                                                </option>

                                            </select>


                                            @error('status')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =====================================
                         SECTION CONTENT
                    ====================================== -->

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>Section</strong> Content
                                </h2>

                            </div>


                            <div class="body">

                                <div class="row">


                                    <!-- Sub Title -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Sub Title
                                            </label>


                                            <input
                                                type="text"
                                                name="sub_title"
                                                class="form-control @error('sub_title') is-invalid @enderror"
                                                placeholder="Enter Sub Title"
                                                value="{{ old('sub_title', $section->sub_title) }}"
                                            >


                                            @error('sub_title')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                    <!-- Title -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Title
                                            </label>


                                            <input
                                                type="text"
                                                name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter Section Title"
                                                value="{{ old('title', $section->title) }}"
                                            >


                                            @error('title')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                    <!-- Content -->

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>
                                                Content
                                            </label>


                                            <textarea
                                                name="content"
                                                rows="6"
                                                class="form-control @error('content') is-invalid @enderror"
                                                placeholder="Enter section content..."
                                            >{{ old('content', $section->content) }}</textarea>


                                            @error('content')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                    <!-- Current Image -->

                                    @if($section->image)

                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label>
                                                    Current Image
                                                </label>

                                                <div>

                                                    <img
                                                        src="{{ asset('storage/' . $section->image) }}"
                                                        alt="{{ $section->title }}"
                                                        style="
                                                            width:180px;
                                                            height:120px;
                                                            object-fit:cover;
                                                            border-radius:8px;
                                                            border:1px solid #ddd;
                                                        "
                                                    >

                                                </div>

                                            </div>

                                        </div>

                                    @endif


                                    <!-- New Image -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                {{ $section->image ? 'Replace Image' : 'Section Image' }}
                                            </label>


                                            <input
                                                type="file"
                                                name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                            >


                                            <small class="text-muted">

                                                Leave empty to keep the current image.

                                            </small>


                                            @error('image')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>
                                    <div class="col-md-12" id="products_field"
                                        style="{{ $section->section_type === 'products' ? 'display: block;' : 'display: none;' }}">

                                        <div class="form-group">

                                            <label>
                                                Select Products
                                            </label>

                                            <select
                                                name="products[]"
                                                id="products"
                                                class="form-control @error('products') is-invalid @enderror"
                                                multiple
                                            >

                                                @foreach($products as $product)

                                                    <option
                                                        value="{{ $product->id }}"
                                                        {{ in_array($product->id, old('products', $selectedProducts ?? [])) ? 'selected' : '' }}
                                                    >
                                                        {{ $product->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <small class="text-muted">
                                                Select one or more products.
                                            </small>

                                            @error('products')
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



                    <!-- =====================================
                         BUTTON DETAILS
                    ====================================== -->

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>Button</strong> Details
                                </h2>

                            </div>


                            <div class="body">

                                <div class="row">


                                    <!-- Button Text -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Button Text
                                            </label>


                                            <input
                                                type="text"
                                                name="button_text"
                                                class="form-control @error('button_text') is-invalid @enderror"
                                                placeholder="Example: Get Started"
                                                value="{{ old('button_text', $section->button_text) }}"
                                            >


                                            @error('button_text')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                    <!-- Button URL -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Button URL
                                            </label>


                                            <input
                                                type="text"
                                                name="button_url"
                                                class="form-control @error('button_url') is-invalid @enderror"
                                                placeholder="Example: /contact"
                                                value="{{ old('button_url', $section->button_url) }}"
                                            >


                                            @error('button_url')

                                                <span class="invalid-feedback" role="alert">

                                                    <strong>
                                                        {{ $message }}
                                                    </strong>

                                                </span>

                                            @enderror

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =====================================
                         ACTION BUTTONS
                    ====================================== -->

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="body text-right">

                                <a
                                    href="{{ route('admin.pages.sections.index', $page) }}"
                                    class="btn btn-secondary"
                                >

                                    <i class="zmdi zmdi-close"></i>

                                    Cancel

                                </a>


                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >

                                    <i class="zmdi zmdi-save"></i>

                                    Update Section

                                </button>

                            </div>

                        </div>

                    </div>


                </div>

            </form>

        </div>

    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sectionType = document.getElementById('section_type');
        const productsField = document.getElementById('products_field');

        function toggleProducts() {

            if (sectionType.value === 'products') {
                productsField.style.display = 'block';
            } else {
                productsField.style.display = 'none';
            }

        }

        sectionType.addEventListener('change', toggleProducts);

        toggleProducts();

    });
</script>
@endsection


{{-- @else

@php
    abort(403);
@endphp

@endcan --}}
