@extends('layouts.app')

@section('title', 'Create Banner')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Create Banner</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.banners.index') }}">Banners</a>
                        </li>
                        <li class="breadcrumb-item active">Create Banner</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Banner</strong> Information</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <!-- Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   placeholder="Enter Banner Title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Banner Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Banner Type <span class="text-danger">*</span></label>
                                            <select name="banner_type" class="form-control @error('banner_type') is-invalid @enderror">
                                                <option value="">Select Type</option>
                                                <option value="homepage_slider" {{ old('banner_type') == 'homepage_slider' ? 'selected' : '' }}>Homepage Slider</option>
                                                <option value="promotional" {{ old('banner_type') == 'promotional' ? 'selected' : '' }}>Promotional Banner</option>
                                                <option value="category" {{ old('banner_type') == 'category' ? 'selected' : '' }}>Category Banner</option>
                                                <option value="festival" {{ old('banner_type') == 'festival' ? 'selected' : '' }}>Festival Banner</option>
                                                <option value="popup" {{ old('banner_type') == 'popup' ? 'selected' : '' }}>Popup Banner</option>
                                                <option value="mobile" {{ old('banner_type') == 'mobile' ? 'selected' : '' }}>Mobile Banner</option>
                                            </select>
                                            @error('banner_type')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Banner Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                                            <small class="text-muted">Recommended size: 1920x500 pixels (Max: 5MB)</small>
                                            @error('image')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Link Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Link Type <span class="text-danger">*</span></label>
                                            <select name="link_type" id="link_type" class="form-control @error('link_type') is-invalid @enderror">
                                                <option value="none" {{ old('link_type') == 'none' ? 'selected' : '' }}>None</option>
                                                <option value="custom_url" {{ old('link_type') == 'custom_url' ? 'selected' : '' }}>Custom URL</option>
                                                <option value="product" {{ old('link_type') == 'product' ? 'selected' : '' }}>Product</option>
                                                <option value="category" {{ old('link_type') == 'category' ? 'selected' : '' }}>Category</option>
                                            </select>
                                            @error('link_type')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Link Value -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="link_value_label">Link Value</label>
                                            <input type="text" name="link_value" id="link_value"
                                                   class="form-control @error('link_value') is-invalid @enderror"
                                                   placeholder="Enter URL or select below" value="{{ old('link_value') }}">
                                            @error('link_value')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Product Selection (Hidden by default) -->
                                    <div class="col-md-6" id="product_select" style="display:none;">
                                        <div class="form-group">
                                            <label>Select Product <span class="text-danger">*</span></label>
                                            <select name="link_value" id="product_value" class="form-control">
                                                <option value="">Select Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ old('link_value') == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Category Selection (Hidden by default) -->
                                    <div class="col-md-6" id="category_select" style="display:none;">
                                        <div class="form-group">
                                            <label>Select Category <span class="text-danger">*</span></label>
                                            <select name="link_value" id="category_value" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('link_value') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Sort Order -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sort Order</label>
                                            <input type="number" name="sort_order"
                                                   class="form-control @error('sort_order') is-invalid @enderror"
                                                   value="{{ old('sort_order', \App\Models\Banner::max('sort_order') + 1) }}" min="0">
                                            @error('sort_order')
                                                <span class="invalid-feedback">
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
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" name="start_date"
                                                   class="form-control @error('start_date') is-invalid @enderror"
                                                   value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" name="end_date"
                                                   class="form-control @error('end_date') is-invalid @enderror"
                                                   value="{{ old('end_date') }}">
                                            @error('end_date')
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

                    <!-- ===================================== ACTION BUTTONS ====================================== -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                                    <i class="zmdi zmdi-close"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i> Create Banner
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
    const linkType = document.getElementById('link_type');
    const linkValue = document.getElementById('link_value');
    const productSelect = document.getElementById('product_select');
    const categorySelect = document.getElementById('category_select');
    const linkValueLabel = document.getElementById('link_value_label');

    // Get the actual select elements inside the hidden divs
    const productSelectElement = document.getElementById('product_value');
    const categorySelectElement = document.getElementById('category_value');

    function toggleLinkFields() {
        const type = linkType.value;

        // Hide all
        productSelect.style.display = 'none';
        categorySelect.style.display = 'none';
        linkValue.style.display = 'none';

        // Remove required from all
        linkValue.removeAttribute('required');
        if (productSelectElement) productSelectElement.removeAttribute('required');
        if (categorySelectElement) categorySelectElement.removeAttribute('required');

        // Show relevant and set required
        if (type === 'custom_url') {
            linkValue.style.display = 'block';
            linkValue.setAttribute('required', 'required');
            linkValueLabel.textContent = 'Custom URL *';
        } else if (type === 'product') {
            productSelect.style.display = 'block';
            if (productSelectElement) {
                productSelectElement.setAttribute('required', 'required');
            }
            linkValueLabel.textContent = 'Select Product *';
        } else if (type === 'category') {
            categorySelect.style.display = 'block';
            if (categorySelectElement) {
                categorySelectElement.setAttribute('required', 'required');
            }
            linkValueLabel.textContent = 'Select Category *';
        } else {
            linkValue.style.display = 'none';
            linkValue.removeAttribute('required');
            linkValueLabel.textContent = 'Link Value';
        }
    }

    // Initial call
    toggleLinkFields();

    // Event listener
    linkType.addEventListener('change', toggleLinkFields);

    // Form validation - prevent submission if required field is empty
    document.querySelector('form').addEventListener('submit', function(e) {
        const type = linkType.value;
        let isValid = true;

        if (type === 'custom_url') {
            const val = linkValue.value.trim();
            if (!val) {
                e.preventDefault();
                alert('Please enter a Custom URL.');
                linkValue.focus();
                isValid = false;
            }
        } else if (type === 'product') {
            const val = productSelectElement ? productSelectElement.value : '';
            if (!val) {
                e.preventDefault();
                alert('Please select a Product.');
                if (productSelectElement) productSelectElement.focus();
                isValid = false;
            }
        } else if (type === 'category') {
            const val = categorySelectElement ? categorySelectElement.value : '';
            if (!val) {
                e.preventDefault();
                alert('Please select a Category.');
                if (categorySelectElement) categorySelectElement.focus();
                isValid = false;
            }
        }

        return isValid;
    });
});
</script>

@endsection
