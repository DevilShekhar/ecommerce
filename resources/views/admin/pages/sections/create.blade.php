@extends('layouts.app')

@section('title', 'Create Page Section')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Create Page Section</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.pages.index') }}">Pages</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.pages.sections.index', $page->id) }}">
                                {{ $page->title }} Sections
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Create Section</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.pages.sections.index', $page->id) }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <form method="POST"
                  action="{{ route('admin.pages.sections.store', $page->id) }}"
                  enctype="multipart/form-data"
                  id="sectionForm">
                @csrf

                <div class="row clearfix">

                    <!-- =====================================
                         SECTION INFORMATION
                    ====================================== -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Section</strong> Information</h2>
                            </div>
                            <div class="body">
                                <div class="row">

                                    <!-- Section Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Section Type <span class="text-danger">*</span></label>
                                            <select name="section_type" id="section_type"
                                                    class="form-control @error('section_type') is-invalid @enderror">
                                                <option value="">Select Section Type</option>
                                                <option value="hero" {{ old('section_type') == 'hero' ? 'selected' : '' }}>Hero</option>
                                                <option value="about" {{ old('section_type') == 'about' ? 'selected' : '' }}>About</option>
                                                <option value="services" {{ old('section_type') == 'services' ? 'selected' : '' }}>Services</option>
                                                <option value="features" {{ old('section_type') == 'features' ? 'selected' : '' }}>Features</option>
                                                <option value="testimonials" {{ old('section_type') == 'testimonials' ? 'selected' : '' }}>Testimonials</option>
                                                <option value="cta" {{ old('section_type') == 'cta' ? 'selected' : '' }}>CTA</option>
                                                <option value="faq" {{ old('section_type') == 'faq' ? 'selected' : '' }}>FAQ</option>
                                                <option value="products" {{ old('section_type') == 'products' ? 'selected' : '' }}>Products</option>
                                                <option value="contact" {{ old('section_type') == 'contact' ? 'selected' : '' }}>Contact Form</option>
                                                <option value="footer" {{ old('section_type') == 'footer' ? 'selected' : '' }}>Footer</option>
                                            </select>
                                            @error('section_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Sort Order -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sort Order <span class="text-danger">*</span></label>
                                            <input type="number" name="sort_order" min="1"
                                                   class="form-control @error('sort_order') is-invalid @enderror"
                                                   value="{{ old('sort_order', 1) }}" placeholder="Enter Sort Order">
                                            @error('sort_order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Inactive</option>
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

                    <!-- =====================================
                         COMMON FIELDS (All Sections)
                    ====================================== -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Section</strong> Content</h2>
                            </div>
                            <div class="body">
                                <div class="row">

                                    <!-- Sub Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Title</label>
                                            <input type="text" name="sub_title"
                                                   class="form-control @error('sub_title') is-invalid @enderror"
                                                   placeholder="Enter Sub Title" value="{{ old('sub_title') }}">
                                            @error('sub_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   placeholder="Enter Section Title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content / Description</label>
                                            <textarea name="content" rows="4"
                                                      class="form-control @error('content') is-invalid @enderror"
                                                      placeholder="Enter section content...">{{ old('content') }}</textarea>
                                            @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Section Image</label>
                                            <input type="file" name="image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                                            @error('image')
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

                    <!-- =====================================
                         TESTIMONIALS REPEATER (Hidden by default)
                    ====================================== -->
                    <div class="col-lg-12" id="testimonials_section" style="display: none;">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Testimonials</strong></h2>
                            </div>
                            <div class="body">
                                <div class="form-group">
                                    <label>Customer Testimonials</label>
                                    <div id="testimonials_container">
                                        <div class="testimonial-item row mb-3" data-index="0">
                                            <div class="col-md-4">
                                                <input type="text" name="testimonials[0][name]"
                                                       class="form-control" placeholder="Customer Name">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="testimonials[0][designation]"
                                                       class="form-control" placeholder="Designation">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="testimonials[0][rating]"
                                                       class="form-control" placeholder="Rating (1-5)" min="1" max="5">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-testimonial" style="width:100%;">
                                                    <i class="zmdi zmdi-close"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <textarea name="testimonials[0][content]"
                                                          class="form-control" rows="2"
                                                          placeholder="Testimonial Content"></textarea>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <input type="file" name="testimonials[0][image]"
                                                       class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add_testimonial">
                                        <i class="zmdi zmdi-plus"></i> Add Testimonial
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- =====================================
                        FAQ REPEATER (Hidden by default)
                    ====================================== -->
                    <div class="col-lg-12" id="faq_section" style="display: none;">
                        <div class="card">
                            <div class="header">
                                <h2><strong>FAQ</strong> (Frequently Asked Questions)</h2>
                            </div>
                            <div class="body">
                                <div class="form-group">
                                    <label>FAQ Items</label>
                                    <div id="faq_container">
                                        <div class="faq-item row mb-3" data-index="0">
                                            <div class="col-md-11">
                                                <input type="text" name="faqs[0][question]"
                                                    class="form-control mb-2"
                                                    placeholder="Enter Question">
                                                <textarea name="faqs[0][answer]"
                                                        class="form-control"
                                                        rows="2"
                                                        placeholder="Enter Answer"></textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-faq" style="width:100%;">
                                                    <i class="zmdi zmdi-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add_faq">
                                        <i class="zmdi zmdi-plus"></i> Add FAQ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =====================================
                        CONTACT FORM (Hidden by default)
                    ====================================== -->
                    <div class="col-lg-12" id="contact_section" style="display: none;">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Contact Form</strong> Configuration</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <!-- Form Action -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Form Action URL</label>
                                            <input type="text" name="form_action"
                                                class="form-control"
                                                placeholder="/contact/submit"
                                                value="{{ old('form_action', route('frontend.contact.submit', [$page->id, '__SECTION_ID__'])) }}">
                                            <small class="text-muted">Where the form will be submitted</small>
                                        </div>
                                    </div>

                                    <!-- Form Method -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Form Method</label>
                                            <select name="form_method" class="form-control">
                                                <option value="POST" {{ old('form_method', 'POST') == 'POST' ? 'selected' : '' }}>POST</option>
                                                <option value="GET" {{ old('form_method') == 'GET' ? 'selected' : '' }}>GET</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Form Fields</label>
                                    <div id="form_fields_container">
                                        <div class="form-field-item row mb-3" data-index="0">
                                            <div class="col-md-3">
                                                <input type="text" name="form_fields[0][label]"
                                                    class="form-control" placeholder="Field Label">
                                            </div>
                                            <div class="col-md-2">
                                                <select name="form_fields[0][type]" class="form-control">

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
                                                <input type="text" name="form_fields[0][name]"
                                                    class="form-control" placeholder="Field Name">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="form_fields[0][placeholder]"
                                                    class="form-control" placeholder="Placeholder">
                                            </div>
                                            <div class="col-md-1">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="form_fields[0][required]" value="1">
                                                        Required
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-form-field" style="width:100%;">
                                                    <i class="zmdi zmdi-close"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-12 mt-2 form-field-options" style="display: none;">
                                                <input type="text" name="form_fields[0][options]"
                                                    class="form-control" placeholder="Options (comma separated: Option 1, Option 2, Option 3)">
                                                <small class="text-muted">For select, checkbox, and radio fields only</small>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add_form_field">
                                        <i class="zmdi zmdi-plus"></i> Add Form Field
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =====================================
     FOOTER SECTION (Hidden by default)
====================================== -->
<div class="col-lg-12" id="footer_section" style="display: none;">
    <div class="card">
        <div class="header">
            <h2><strong>Footer</strong> Configuration</h2>
        </div>
        <div class="body">
            
            <!-- Logo -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Footer Logo</label>
                        <input type="file" name="logo" 
                               class="form-control" 
                               accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml">
                        <small class="text-muted">Upload logo for footer (Recommended: PNG or SVG)</small>
                    </div>
                </div>
            </div>

            <!-- Addresses Repeater -->
            <div class="form-group">
                <label>Addresses</label>
                <div id="addresses_container">
                    <div class="address-item row mb-3" data-index="0">
                        <div class="col-md-12">
                            <input type="text" name="addresses[0][address]" 
                                   class="form-control mb-2" 
                                   placeholder="Street Address">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="addresses[0][city]" 
                                   class="form-control" 
                                   placeholder="City">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="addresses[0][state]" 
                                   class="form-control" 
                                   placeholder="State/Province">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="addresses[0][zip]" 
                                   class="form-control" 
                                   placeholder="Zip/Postal">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-address" style="width:100%;">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                        </div>
                        <div class="col-md-12 mt-2">
                            <input type="text" name="addresses[0][country]" 
                                   class="form-control" 
                                   placeholder="Country">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="add_address">
                    <i class="zmdi zmdi-plus"></i> Add Address
                </button>
            </div>

        </div>
    </div>
</div>

                    <!-- =====================================
                         PRODUCTS SELECTION (Hidden by default)
                    ====================================== -->
                    <div class="col-lg-12" id="products_section" style="display: none;">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Products</strong> Selection</h2>
                            </div>
                            <div class="body">
                                <div class="form-group">
                                    <label>Select Products</label>
                                    <select name="products[]" id="products"
                                            class="form-control" multiple
                                            style="min-height: 180px;">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ in_array($product->id, old('products', [])) ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Hold Ctrl and select multiple products.</small>
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
                                <h2><strong>Button</strong> Details</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Button Text</label>
                                            <input type="text" name="button_text"
                                                   class="form-control @error('button_text') is-invalid @enderror"
                                                   placeholder="Example: Get Started" value="{{ old('button_text') }}">
                                            @error('button_text')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Button URL</label>
                                            <input type="text" name="button_url"
                                                   class="form-control @error('button_url') is-invalid @enderror"
                                                   placeholder="Example: /contact" value="{{ old('button_url') }}">
                                            @error('button_url')
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

                    <!-- =====================================
                         ACTION BUTTONS
                    ====================================== -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('admin.pages.sections.index', $page->id) }}" class="btn btn-secondary">
                                    <i class="zmdi zmdi-close"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i> Create Section
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

        // Hide all special sections first
        testimonialsSection.style.display = 'none';
        productsSection.style.display = 'none';
        faqSection.style.display = 'none';
        contactSection.style.display = 'none';
        footerSection.style.display = 'none';

        // Show relevant section based on type
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

    // =============================================
    // Testimonials Repeater
    // =============================================
    function initTestimonialsRepeater() {
        const container = document.getElementById('testimonials_container');
        let testimonialCount = container.children.length;

        document.getElementById('add_testimonial')?.addEventListener('click', function() {
            const newItem = container.querySelector('.testimonial-item').cloneNode(true);
            const index = testimonialCount++;

            newItem.querySelectorAll('input, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                    el.value = '';
                }
            });

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
        let faqCount = container.children.length;

        document.getElementById('add_faq')?.addEventListener('click', function() {
            const newItem = container.querySelector('.faq-item').cloneNode(true);
            const index = faqCount++;

            newItem.querySelectorAll('input, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
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
        let fieldCount = container.children.length;

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
            const newItem = container.querySelector('.form-field-item').cloneNode(true);
            const index = fieldCount++;

            // Clear values and update indexes
            newItem.querySelectorAll('input, select, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                    if (el.type !== 'checkbox' && el.type !== 'file') {
                        el.value = '';
                    }
                }
            });

            // Reset checkbox
            const checkbox = newItem.querySelector('input[type="checkbox"]');
            if (checkbox) checkbox.checked = false;

            // Update remove button
            const removeBtn = newItem.querySelector('.remove-form-field');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (container.children.length > 1) {
                        this.closest('.form-field-item').remove();
                    }
                });
            }

            // Add event listener for type change
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
        let addressCount = container.children.length;

        // Add Address
        document.getElementById('add_address')?.addEventListener('click', function() {
            const newItem = container.querySelector('.address-item').cloneNode(true);
            const index = addressCount++;

            newItem.querySelectorAll('input').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
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
    // Event Listeners
    // =============================================
    sectionType.addEventListener('change', toggleSections);

    // Initialize all on page load
    toggleSections();
    initTestimonialsRepeater();
    initFaqRepeater();
    initFormFieldsRepeater();
    initAddressesRepeater();

    // =============================================
    // Form Validation
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
                    alert('Please enter testimonial content for testimonial ' + (index + 1));
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

});
</script>

@endsection
