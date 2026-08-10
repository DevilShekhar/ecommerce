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
                                                <option value="products" {{ old('section_type') == 'products' ? 'selected' : '' }}>Products</option>
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

    // Function to show/hide sections based on type
    function toggleSections() {
        const selectedType = sectionType.value;

        // Hide all special sections first
        testimonialsSection.style.display = 'none';
        productsSection.style.display = 'none';

        // Show relevant section based on type
        if (selectedType === 'testimonials') {
            testimonialsSection.style.display = 'block';
        } else if (selectedType === 'products') {
            productsSection.style.display = 'block';
        }
    }

    // Testimonials Repeater Functions
    function initTestimonialsRepeater() {
        const container = document.getElementById('testimonials_container');
        let testimonialCount = container.children.length;

        // Add Testimonial
        document.getElementById('add_testimonial')?.addEventListener('click', function() {
            const newItem = container.querySelector('.testimonial-item').cloneNode(true);
            const index = testimonialCount++;

            // Clear values and update indexes
            newItem.querySelectorAll('input, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
                    el.value = '';
                }
            });

            // Update remove button
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

        // Remove Testimonial
        document.querySelectorAll('.remove-testimonial').forEach(btn => {
            btn.addEventListener('click', function() {
                if (container.children.length > 1) {
                    this.closest('.testimonial-item').remove();
                }
            });
        });
    }

    // Event listener for section type change
    sectionType.addEventListener('change', toggleSections);

    // Initialize on page load
    toggleSections();
    initTestimonialsRepeater();

    // Show validation for required fields
    document.getElementById('sectionForm')?.addEventListener('submit', function(e) {
        const selectedType = sectionType.value;

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
                    alert('Please enter testimonial content for ' + (name ? name.value : 'customer ' + (index + 1)));
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

        if (selectedType === 'products') {
            const productsSelect = document.getElementById('products');
            if (productsSelect && productsSelect.selectedOptions.length === 0) {
                alert('Please select at least one product.');
                productsSelect.focus();
                e.preventDefault();
                return false;
            }
        }
    });

});
</script>

@endsection
