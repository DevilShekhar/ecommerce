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
                id="sectionForm"
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
                                                id="section_type"
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
                                                    'cta',
                                                    'products',
                                                    'contact',
                                                    'footer'
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


                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =====================================
                         TESTIMONIALS REPEATER
                    ====================================== -->

                    <div class="col-lg-12" id="testimonials_section"
                         style="{{ $section->section_type === 'testimonials' ? 'display: block;' : 'display: none;' }}">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>Testimonials</strong>
                                </h2>

                            </div>

                            <div class="body">

                                <div class="form-group">

                                    <label>Customer Testimonials</label>

                                    <div id="testimonials_container">

                                        @php
                                            $testimonials = $section->testimonials ? json_decode($section->testimonials, true) : [];
                                        @endphp

                                        @if(!empty($testimonials))

                                            @foreach($testimonials as $index => $testimonial)

                                                <div class="testimonial-item row mb-3" data-index="{{ $index }}">

                                                    <div class="col-md-4">

                                                        <input type="text"
                                                               name="testimonials[{{ $index }}][name]"
                                                               class="form-control"
                                                               placeholder="Customer Name"
                                                               value="{{ $testimonial['name'] ?? '' }}">

                                                    </div>

                                                    <div class="col-md-4">

                                                        <input type="text"
                                                               name="testimonials[{{ $index }}][designation]"
                                                               class="form-control"
                                                               placeholder="Designation"
                                                               value="{{ $testimonial['designation'] ?? '' }}">

                                                    </div>

                                                    <div class="col-md-3">

                                                        <input type="number"
                                                               name="testimonials[{{ $index }}][rating]"
                                                               class="form-control"
                                                               placeholder="Rating (1-5)"
                                                               min="1"
                                                               max="5"
                                                               value="{{ $testimonial['rating'] ?? '' }}">

                                                    </div>

                                                    <div class="col-md-1">

                                                        <button type="button"
                                                                class="btn btn-danger remove-testimonial"
                                                                style="width:100%;">

                                                            <i class="zmdi zmdi-close"></i>

                                                        </button>

                                                    </div>

                                                    <div class="col-md-12 mt-2">

                                                        <textarea name="testimonials[{{ $index }}][content]"
                                                                  class="form-control"
                                                                  rows="2"
                                                                  placeholder="Testimonial Content">{{ $testimonial['content'] ?? '' }}</textarea>

                                                    </div>

                                                    <div class="col-md-12 mt-2">

                                                        @if(!empty($testimonial['image']))

                                                            <div class="mb-2">

                                                                <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                                                     alt="Testimonial Image"
                                                                     style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">

                                                            </div>

                                                        @endif

                                                        <input type="file"
                                                               name="testimonials[{{ $index }}][image]"
                                                               class="form-control"
                                                               accept="image/*">

                                                        <small class="text-muted">Leave empty to keep current image.</small>

                                                    </div>

                                                </div>

                                            @endforeach

                                        @else

                                            <!-- Default empty testimonial item -->

                                            <div class="testimonial-item row mb-3" data-index="0">

                                                <div class="col-md-4">

                                                    <input type="text"
                                                           name="testimonials[0][name]"
                                                           class="form-control"
                                                           placeholder="Customer Name">

                                                </div>

                                                <div class="col-md-4">

                                                    <input type="text"
                                                           name="testimonials[0][designation]"
                                                           class="form-control"
                                                           placeholder="Designation">

                                                </div>

                                                <div class="col-md-3">

                                                    <input type="number"
                                                           name="testimonials[0][rating]"
                                                           class="form-control"
                                                           placeholder="Rating (1-5)"
                                                           min="1"
                                                           max="5">

                                                </div>

                                                <div class="col-md-1">

                                                    <button type="button"
                                                            class="btn btn-danger remove-testimonial"
                                                            style="width:100%;">

                                                        <i class="zmdi zmdi-close"></i>

                                                    </button>

                                                </div>

                                                <div class="col-md-12 mt-2">

                                                    <textarea name="testimonials[0][content]"
                                                              class="form-control"
                                                              rows="2"
                                                              placeholder="Testimonial Content"></textarea>

                                                </div>

                                                <div class="col-md-12 mt-2">

                                                    <input type="file"
                                                           name="testimonials[0][image]"
                                                           class="form-control"
                                                           accept="image/*">

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                    <button type="button"
                                            class="btn btn-primary"
                                            id="add_testimonial">

                                        <i class="zmdi zmdi-plus"></i> Add Testimonial

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =====================================
                         FAQ REPEATER
                    ====================================== -->

                    <div class="col-lg-12" id="faq_section"
                         style="{{ $section->section_type === 'faq' ? 'display: block;' : 'display: none;' }}">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>FAQ</strong> (Frequently Asked Questions)
                                </h2>

                            </div>

                            <div class="body">

                                <div class="form-group">

                                    <label>FAQ Items</label>

                                    <div id="faq_container">

                                        @php
                                            $faqs = $section->faqs ? json_decode($section->faqs, true) : [];
                                        @endphp

                                        @if(!empty($faqs))

                                            @foreach($faqs as $index => $faq)

                                                <div class="faq-item row mb-3" data-index="{{ $index }}">

                                                    <div class="col-md-11">

                                                        <input type="text"
                                                               name="faqs[{{ $index }}][question]"
                                                               class="form-control mb-2"
                                                               placeholder="Enter Question"
                                                               value="{{ $faq['question'] ?? '' }}">

                                                        <textarea name="faqs[{{ $index }}][answer]"
                                                                  class="form-control"
                                                                  rows="2"
                                                                  placeholder="Enter Answer">{{ $faq['answer'] ?? '' }}</textarea>

                                                    </div>

                                                    <div class="col-md-1">

                                                        <button type="button"
                                                                class="btn btn-danger remove-faq"
                                                                style="width:100%;">

                                                            <i class="zmdi zmdi-close"></i>

                                                        </button>

                                                    </div>

                                                </div>

                                            @endforeach

                                        @else

                                            <!-- Default empty FAQ item -->

                                            <div class="faq-item row mb-3" data-index="0">

                                                <div class="col-md-11">

                                                    <input type="text"
                                                           name="faqs[0][question]"
                                                           class="form-control mb-2"
                                                           placeholder="Enter Question">

                                                    <textarea name="faqs[0][answer]"
                                                              class="form-control"
                                                              rows="2"
                                                              placeholder="Enter Answer"></textarea>

                                                </div>

                                                <div class="col-md-1">

                                                    <button type="button"
                                                            class="btn btn-danger remove-faq"
                                                            style="width:100%;">

                                                        <i class="zmdi zmdi-close"></i>

                                                    </button>

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                    <button type="button"
                                            class="btn btn-primary"
                                            id="add_faq">

                                        <i class="zmdi zmdi-plus"></i> Add FAQ

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =====================================
                         CONTACT FORM (Hidden by default)
                    ====================================== -->

                    <div class="col-lg-12" id="contact_section"
                         style="{{ $section->section_type === 'contact' ? 'display: block;' : 'display: none;' }}">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>Contact Form</strong> Configuration
                                </h2>

                            </div>

                            <div class="body">

                                <div class="row">

                                    <!-- Form Action -->
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Form Action URL</label>

                                            <input type="text"
                                                   name="form_action"
                                                   class="form-control"
                                                   placeholder="/contact/submit"
                                                   value="{{ old('form_action', $section->form_action ?? '/contact/submit') }}">

                                            <small class="text-muted">Where the form will be submitted</small>

                                        </div>

                                    </div>

                                    <!-- Form Method -->
                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Form Method</label>

                                            <select name="form_method" class="form-control">

                                                <option value="POST" {{ old('form_method', $section->form_method ?? 'POST') == 'POST' ? 'selected' : '' }}>
                                                    POST
                                                </option>

                                                <option value="GET" {{ old('form_method', $section->form_method ?? 'POST') == 'GET' ? 'selected' : '' }}>
                                                    GET
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Form Fields</label>

                                    <div id="form_fields_container">

                                        @php
                                            $formFields = $section->form_fields ? json_decode($section->form_fields, true) : [];
                                        @endphp

                                        @if(!empty($formFields))

                                            @foreach($formFields as $index => $field)

                                                <div class="form-field-item row mb-3" data-index="{{ $index }}">

                                                    <div class="col-md-3">

                                                        <input type="text"
                                                               name="form_fields[{{ $index }}][label]"
                                                               class="form-control"
                                                               placeholder="Field Label"
                                                               value="{{ $field['label'] ?? '' }}">

                                                    </div>

                                                    <div class="col-md-2">

                                                        <select name="form_fields[{{ $index }}][type]" class="form-control">

                                                            <option value="text"
                                                                {{ ($field['type'] ?? '') === 'text' ? 'selected' : '' }}>
                                                                Text
                                                            </option>

                                                            <option value="email"
                                                                {{ ($field['type'] ?? '') === 'email' ? 'selected' : '' }}>
                                                                Email
                                                            </option>

                                                            <option value="textarea"
                                                                {{ ($field['type'] ?? '') === 'textarea' ? 'selected' : '' }}>
                                                                Textarea
                                                            </option>

                                                            <option value="number"
                                                                {{ ($field['type'] ?? '') === 'number' ? 'selected' : '' }}>
                                                                Number
                                                            </option>

                                                            <option value="phone"
                                                                {{ ($field['type'] ?? '') === 'phone' ? 'selected' : '' }}>
                                                                Phone
                                                            </option>

                                                            <option value="select"
                                                                {{ ($field['type'] ?? '') === 'select' ? 'selected' : '' }}>
                                                                Select
                                                            </option>

                                                            <option value="checkbox"
                                                                {{ ($field['type'] ?? '') === 'checkbox' ? 'selected' : '' }}>
                                                                Checkbox
                                                            </option>

                                                            <option value="radio"
                                                                {{ ($field['type'] ?? '') === 'radio' ? 'selected' : '' }}>
                                                                Radio
                                                            </option>

                                                            <option value="file"
                                                                {{ ($field['type'] ?? '') === 'file' ? 'selected' : '' }}>
                                                                File
                                                            </option>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-2">

                                                        <input type="text"
                                                               name="form_fields[{{ $index }}][name]"
                                                               class="form-control"
                                                               placeholder="Field Name"
                                                               value="{{ $field['name'] ?? '' }}">

                                                    </div>

                                                    <div class="col-md-3">

                                                        <input type="text"
                                                               name="form_fields[{{ $index }}][placeholder]"
                                                               class="form-control"
                                                               placeholder="Placeholder"
                                                               value="{{ $field['placeholder'] ?? '' }}">

                                                    </div>

                                                    <div class="col-md-1">

                                                        <div class="checkbox">

                                                            <label>

                                                                <input type="checkbox"
                                                                       name="form_fields[{{ $index }}][required]"
                                                                       value="1"
                                                                       {{ isset($field['required']) && $field['required'] ? 'checked' : '' }}>

                                                                Required

                                                            </label>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-1">

                                                        <button type="button"
                                                                class="btn btn-danger remove-form-field"
                                                                style="width:100%;">

                                                            <i class="zmdi zmdi-close"></i>

                                                        </button>

                                                    </div>

                                                    <div class="col-md-12 mt-2 form-field-options"
                                                         style="{{ in_array($field['type'] ?? '', ['select', 'checkbox', 'radio']) ? 'display: block;' : 'display: none;' }}">

                                                        <input type="text"
                                                               name="form_fields[{{ $index }}][options]"
                                                               class="form-control"
                                                               placeholder="Options (comma separated: Option 1, Option 2, Option 3)"
                                                               value="{{ isset($field['options']) && is_array($field['options']) ? implode(', ', $field['options']) : '' }}">

                                                        <small class="text-muted">For select, checkbox, and radio fields only</small>

                                                    </div>

                                                </div>

                                            @endforeach

                                        @else

                                            <!-- Default empty form field item -->

                                            <div class="form-field-item row mb-3" data-index="0">

                                                <div class="col-md-3">

                                                    <input type="text"
                                                           name="form_fields[0][label]"
                                                           class="form-control"
                                                           placeholder="Field Label">

                                                </div>

                                                <div class="col-md-2">

                                                    <select name="form_fields[0][type]" class="form-control">

                                                        <option value="text">Text</option>
                                                        <option value="email">Email</option>
                                                        <option value="textarea">Textarea</option>
                                                        <option value="number">Number</option>
                                                        <option value="phone">Phone</option>
                                                        <option value="select">Select</option>
                                                        <option value="checkbox">Checkbox</option>
                                                        <option value="radio">Radio</option>
                                                        <option value="file">File</option>

                                                    </select>

                                                </div>

                                                <div class="col-md-2">

                                                    <input type="text"
                                                           name="form_fields[0][name]"
                                                           class="form-control"
                                                           placeholder="Field Name">

                                                </div>

                                                <div class="col-md-3">

                                                    <input type="text"
                                                           name="form_fields[0][placeholder]"
                                                           class="form-control"
                                                           placeholder="Placeholder">

                                                </div>

                                                <div class="col-md-1">

                                                    <div class="checkbox">

                                                        <label>

                                                            <input type="checkbox"
                                                                   name="form_fields[0][required]"
                                                                   value="1">

                                                            Required

                                                        </label>

                                                    </div>

                                                </div>

                                                <div class="col-md-1">

                                                    <button type="button"
                                                            class="btn btn-danger remove-form-field"
                                                            style="width:100%;">

                                                        <i class="zmdi zmdi-close"></i>

                                                    </button>

                                                </div>

                                                <div class="col-md-12 mt-2 form-field-options" style="display: none;">

                                                    <input type="text"
                                                           name="form_fields[0][options]"
                                                           class="form-control"
                                                           placeholder="Options (comma separated: Option 1, Option 2, Option 3)">

                                                    <small class="text-muted">For select, checkbox, and radio fields only</small>

                                                </div>

                                            </div>

                                        @endif

                                    </div>

                                    <button type="button"
                                            class="btn btn-primary"
                                            id="add_form_field">

                                        <i class="zmdi zmdi-plus"></i> Add Form Field

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- =====================================
     FOOTER SECTION
====================================== -->
<div class="col-lg-12" id="footer_section"
     style="{{ $section->section_type === 'footer' ? 'display: block;' : 'display: none;' }}">

    <div class="card">

        <div class="header">

            <h2>
                <strong>Footer</strong> Configuration
            </h2>

        </div>

        <div class="body">

            <!-- =============================================
                 CURRENT LOGO
            ============================================== -->
            @if($section->logo)

                <div class="row mb-3">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Current Logo</label>

                            <div>

                                <img
                                    src="{{ asset('storage/' . $section->logo) }}"
                                    alt="Footer Logo"
                                    style="
                                        max-height: 80px;
                                        border-radius: 8px;
                                        border: 1px solid #ddd;
                                        padding: 8px;
                                        background: #fff;
                                    "
                                >

                            </div>

                        </div>

                    </div>

                </div>

            @endif


            <!-- =============================================
                 LOGO UPLOAD
            ============================================== -->
            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>
                            {{ $section->logo ? 'Replace Logo' : 'Footer Logo' }}
                        </label>

                        <input
                            type="file"
                            name="logo"
                            class="form-control @error('logo') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml"
                        >

                        <small class="text-muted">
                            {{ $section->logo ? 'Leave empty to keep current logo.' : 'Upload logo for footer (Recommended: PNG or SVG)' }}
                        </small>

                        @error('logo')

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $message }}</strong>

                            </span>

                        @enderror

                    </div>

                </div>

            </div>


            <!-- =============================================
                 ADDRESSES REPEATER
            ============================================== -->
            <div class="form-group">

                <label>Addresses</label>

                <div id="addresses_container">

                    @php
                        $addresses = $section->addresses ? json_decode($section->addresses, true) : [];
                    @endphp

                    @if(!empty($addresses))

                        @foreach($addresses as $index => $address)

                            <div class="address-item row mb-3" data-index="{{ $index }}">

                                <div class="col-md-12">

                                    <input type="text"
                                           name="addresses[{{ $index }}][address]"
                                           class="form-control mb-2"
                                           placeholder="Street Address"
                                           value="{{ $address['address'] ?? '' }}">

                                </div>

                                <div class="col-md-4">

                                    <input type="text"
                                           name="addresses[{{ $index }}][city]"
                                           class="form-control"
                                           placeholder="City"
                                           value="{{ $address['city'] ?? '' }}">

                                </div>

                                <div class="col-md-4">

                                    <input type="text"
                                           name="addresses[{{ $index }}][state]"
                                           class="form-control"
                                           placeholder="State/Province"
                                           value="{{ $address['state'] ?? '' }}">

                                </div>

                                <div class="col-md-2">

                                    <input type="text"
                                           name="addresses[{{ $index }}][zip]"
                                           class="form-control"
                                           placeholder="Zip/Postal"
                                           value="{{ $address['zip'] ?? '' }}">

                                </div>

                                <div class="col-md-1">

                                    <button type="button"
                                            class="btn btn-danger remove-address"
                                            style="width:100%;">

                                        <i class="zmdi zmdi-close"></i>

                                    </button>

                                </div>

                                <div class="col-md-12 mt-2">

                                    <input type="text"
                                           name="addresses[{{ $index }}][country]"
                                           class="form-control"
                                           placeholder="Country"
                                           value="{{ $address['country'] ?? '' }}">

                                </div>

                            </div>

                        @endforeach

                    @else

                        <!-- Default empty address item -->

                        <div class="address-item row mb-3" data-index="0">

                            <div class="col-md-12">

                                <input type="text"
                                       name="addresses[0][address]"
                                       class="form-control mb-2"
                                       placeholder="Street Address">

                            </div>

                            <div class="col-md-4">

                                <input type="text"
                                       name="addresses[0][city]"
                                       class="form-control"
                                       placeholder="City">

                            </div>

                            <div class="col-md-4">

                                <input type="text"
                                       name="addresses[0][state]"
                                       class="form-control"
                                       placeholder="State/Province">

                            </div>

                            <div class="col-md-2">

                                <input type="text"
                                       name="addresses[0][zip]"
                                       class="form-control"
                                       placeholder="Zip/Postal">

                            </div>

                            <div class="col-md-1">

                                <button type="button"
                                        class="btn btn-danger remove-address"
                                        style="width:100%;">

                                    <i class="zmdi zmdi-close"></i>

                                </button>

                            </div>

                            <div class="col-md-12 mt-2">

                                <input type="text"
                                       name="addresses[0][country]"
                                       class="form-control"
                                       placeholder="Country">

                            </div>

                        </div>

                    @endif

                </div>

                <button type="button"
                        class="btn btn-primary"
                        id="add_address">

                    <i class="zmdi zmdi-plus"></i> Add Address

                </button>

            </div>

        </div>

    </div>

</div>



                    <!-- =====================================
                         PRODUCTS SELECTION
                    ====================================== -->

                    <div class="col-lg-12" id="products_section"
                         style="{{ $section->section_type === 'products' ? 'display: block;' : 'display: none;' }}">

                        <div class="card">

                            <div class="header">

                                <h2>
                                    <strong>Products</strong> Selection
                                </h2>

                            </div>

                            <div class="body">

                                <div class="form-group">

                                    <label>Select Products</label>

                                    <select
                                        name="products[]"
                                        id="products"
                                        class="form-control @error('products') is-invalid @enderror"
                                        multiple
                                        style="min-height: 180px;">

                                        @foreach($products as $product)

                                            <option
                                                value="{{ $product->id }}"
                                                {{ in_array($product->id, old('products', $selectedProducts ?? [])) ? 'selected' : '' }}
                                            >
                                                {{ $product->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    <small class="text-muted">Hold Ctrl and select multiple products.</small>

                                    @error('products')
                                        <span class="invalid-feedback d-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

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
document.addEventListener('DOMContentLoaded', function() {

    const sectionType = document.getElementById('section_type');
    const testimonialsSection = document.getElementById('testimonials_section');
    const productsSection = document.getElementById('products_section');
    const faqSection = document.getElementById('faq_section');
    const contactSection = document.getElementById('contact_section');
    const footerSection = document.getElementById('footer_section');

    // =============================================
    // Toggle Sections
    // =============================================
    function toggleSections() {
        const selectedType = sectionType.value;

        testimonialsSection.style.display = 'none';
        productsSection.style.display = 'none';
        faqSection.style.display = 'none';
        contactSection.style.display = 'none';
        footerSection.style.display = 'none';

        if (selectedType === 'testimonials') {
            testimonialsSection.style.display = 'block';
        } else if (selectedType === 'products') {
            productsSection.style.display = 'block';
        } else if (selectedType === 'faq') {
            faqSection.style.display = 'block';
        } else if (selectedType === 'contact') {
            contactSection.style.display = 'block';
        } else if (selectedType === 'footer') {
            footerSection.style.display = 'block';
        }
    }

    sectionType.addEventListener('change', toggleSections);

    // =============================================
    // Testimonials Repeater
    // =============================================
    function initTestimonialsRepeater() {
        const container = document.getElementById('testimonials_container');

        document.getElementById('add_testimonial')?.addEventListener('click', function() {
            const items = container.querySelectorAll('.testimonial-item');
            const newIndex = items.length;

            const newItem = container.querySelector('.testimonial-item').cloneNode(true);

            newItem.querySelectorAll('input, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                    el.value = '';
                }
            });

            const fileInput = newItem.querySelector('input[type="file"]');
            if (fileInput) fileInput.value = '';

            const imgPreview = newItem.querySelector('img');
            if (imgPreview) imgPreview.remove();

            const removeBtn = newItem.querySelector('.remove-testimonial');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (container.children.length > 1) {
                        this.closest('.testimonial-item').remove();
                    }
                });
            }

            container.appendChild(newItem);
        });

        document.querySelectorAll('.remove-testimonial').forEach(btn => {
            btn.addEventListener('click', function() {
                if (container.children.length > 1) {
                    this.closest('.testimonial-item').remove();
                }
            });
        });
    }

    // =============================================
    // FAQ Repeater
    // =============================================
    function initFaqRepeater() {
        const container = document.getElementById('faq_container');

        document.getElementById('add_faq')?.addEventListener('click', function() {
            const items = container.querySelectorAll('.faq-item');
            const newIndex = items.length;

            const newItem = container.querySelector('.faq-item').cloneNode(true);

            newItem.querySelectorAll('input, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                    el.value = '';
                }
            });

            const removeBtn = newItem.querySelector('.remove-faq');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (container.children.length > 1) {
                        this.closest('.faq-item').remove();
                    }
                });
            }

            container.appendChild(newItem);
        });

        document.querySelectorAll('.remove-faq').forEach(btn => {
            btn.addEventListener('click', function() {
                if (container.children.length > 1) {
                    this.closest('.faq-item').remove();
                }
            });
        });
    }

    // =============================================
    // Form Fields Repeater
    // =============================================
    function initFormFieldsRepeater() {
        const container = document.getElementById('form_fields_container');

        // Show/hide options based on field type
        function toggleOptionsVisibility(fieldItem) {
            const typeSelect = fieldItem.querySelector('select[name$="[type]"]');
            const optionsDiv = fieldItem.querySelector('.form-field-options');

            if (typeSelect) {
                const type = typeSelect.value;
                if (type === 'select' || type === 'checkbox' || type === 'radio') {
                    optionsDiv.style.display = 'block';
                } else {
                    optionsDiv.style.display = 'none';
                }
            }
        }

        // Add Form Field
        document.getElementById('add_form_field')?.addEventListener('click', function() {
            const items = container.querySelectorAll('.form-field-item');
            const newIndex = items.length;

            const newItem = container.querySelector('.form-field-item').cloneNode(true);

            newItem.querySelectorAll('input, select, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                    if (el.type !== 'checkbox' && el.type !== 'file') {
                        el.value = '';
                    }
                }
            });

            const checkbox = newItem.querySelector('input[type="checkbox"]');
            if (checkbox) checkbox.checked = false;

            const removeBtn = newItem.querySelector('.remove-form-field');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (container.children.length > 1) {
                        this.closest('.form-field-item').remove();
                    }
                });
            }

            const typeSelect = newItem.querySelector('select[name$="[type]"]');
            if (typeSelect) {
                typeSelect.addEventListener('change', function() {
                    toggleOptionsVisibility(this.closest('.form-field-item'));
                });
            }

            container.appendChild(newItem);
            toggleOptionsVisibility(newItem);
        });

        // Remove Form Field
        document.querySelectorAll('.remove-form-field').forEach(btn => {
            btn.addEventListener('click', function() {
                if (container.children.length > 1) {
                    this.closest('.form-field-item').remove();
                }
            });
        });

        // Initialize type change listeners
        document.querySelectorAll('select[name$="[type]"]').forEach(select => {
            select.addEventListener('change', function() {
                toggleOptionsVisibility(this.closest('.form-field-item'));
            });
            toggleOptionsVisibility(select.closest('.form-field-item'));
        });
    }

    // =============================================
    // Addresses Repeater (For Footer)
    // =============================================
    function initAddressesRepeater() {
        const container = document.getElementById('addresses_container');
        if (!container) return;

        // Add Address
        document.getElementById('add_address')?.addEventListener('click', function() {
            const items = container.querySelectorAll('.address-item');
            const newIndex = items.length;

            const newItem = container.querySelector('.address-item').cloneNode(true);

            newItem.querySelectorAll('input').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                    el.value = '';
                }
            });

            const removeBtn = newItem.querySelector('.remove-address');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (container.children.length > 1) {
                        this.closest('.address-item').remove();
                    }
                });
            }

            container.appendChild(newItem);
        });

        // Remove Address
        document.querySelectorAll('.remove-address').forEach(btn => {
            btn.addEventListener('click', function() {
                if (container.children.length > 1) {
                    this.closest('.address-item').remove();
                }
            });
        });
    }

    // =============================================
    // Validation
    // =============================================
    document.getElementById('sectionForm')?.addEventListener('submit', function(e) {
        const selectedType = sectionType.value;

        // Testimonials Validation
        if (selectedType === 'testimonials') {
            const testimonialItems = document.querySelectorAll('.testimonial-item');
            let hasError = false;

            testimonialItems.forEach((item, index) => {
                const name = item.querySelector('input[name^="testimonials"][name$="[name]"]');
                const content = item.querySelector('textarea[name^="testimonials"][name$="[content]"]');

                if (name && !name.value.trim()) {
                    alert('Please enter customer name for testimonial ' + (index + 1));
                    name.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }

                if (content && !content.value.trim()) {
                    alert('Please enter testimonial content for ' + (index + 1));
                    content.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }
            });

            if (hasError) {
                e.preventDefault();
                return false;
            }
        }

        // FAQ Validation
        if (selectedType === 'faq') {
            const faqItems = document.querySelectorAll('.faq-item');
            let hasError = false;

            faqItems.forEach((item, index) => {
                const question = item.querySelector('input[name^="faqs"][name$="[question]"]');
                const answer = item.querySelector('textarea[name^="faqs"][name$="[answer]"]');

                if (question && !question.value.trim()) {
                    alert('Please enter question for FAQ ' + (index + 1));
                    question.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }

                if (answer && !answer.value.trim()) {
                    alert('Please enter answer for FAQ ' + (index + 1));
                    answer.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }
            });

            if (hasError) {
                e.preventDefault();
                return false;
            }
        }

        // Contact Form Validation
        if (selectedType === 'contact') {
            const fieldItems = document.querySelectorAll('.form-field-item');
            let hasError = false;

            fieldItems.forEach((item, index) => {
                const label = item.querySelector('input[name$="[label]"]');
                const name = item.querySelector('input[name$="[name]"]');

                if (label && !label.value.trim()) {
                    alert('Please enter label for field ' + (index + 1));
                    label.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }

                if (name && !name.value.trim()) {
                    alert('Please enter name for field ' + (index + 1));
                    name.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }
            });

            if (hasError) {
                e.preventDefault();
                return false;
            }
        }

        // Products Validation
        if (selectedType === 'products') {
            const productsSelect = document.getElementById('products');
            if (productsSelect && productsSelect.selectedOptions.length === 0) {
                alert('Please select at least one product.');
                productsSelect.focus();
                e.preventDefault();
                return false;
            }
        }

        // Footer Validation
        if (selectedType === 'footer') {
            const addressItems = document.querySelectorAll('.address-item');
            let hasError = false;

            addressItems.forEach((item, index) => {
                const address = item.querySelector('input[name$="[address]"]');
                const city = item.querySelector('input[name$="[city]"]');
                const state = item.querySelector('input[name$="[state]"]');

                if (address && !address.value.trim() && !city?.value.trim() && !state?.value.trim()) {
                    alert('Please enter at least address, city, or state for address ' + (index + 1));
                    address?.focus();
                    hasError = true;
                    e.preventDefault();
                    return false;
                }
            });

            if (hasError) {
                e.preventDefault();
                return false;
            }
        }
    });

    // =============================================
    // Initialize on page load
    // =============================================
    toggleSections();
    initTestimonialsRepeater();
    initFaqRepeater();
    initFormFieldsRepeater();
    initAddressesRepeater();

});
</script>

@endsection
