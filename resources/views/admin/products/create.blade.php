@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Create Product</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.index') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active">Create Product</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('products.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i> Back
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

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Product</strong> Information</h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <!-- Category -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category <span class="text-danger">*</span></label>
                                                <select name="category_id" id="category_id" class="form-control" required>
                                                    <option value="">-- Select Category --</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Sub Category -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Sub Category <span class="text-danger">*</span>
                                                </label>

                                                <select name="sub_category_id" id="sub_category_id" class="form-control"
                                                    required>
                                                    <option value="">-- Select Sub Category --</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Brand -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select name="brand_id" class="form-control">
                                                    <option value="">-- Select Brand --</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Product Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}" placeholder="Enter Product Name" required>
                                            </div>
                                        </div>

                                        <!-- SKU -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SKU <span class="text-danger">*</span></label>
                                                <input type="text" name="sku" class="form-control" value="{{ old('sku') }}"
                                                    placeholder="e.g. PRD-1001" required>
                                                <small class="form-text text-muted">
                                                    <strong>SKU (Stock Keeping Unit):</strong> A unique alphanumeric
                                                    identification code used to track product inventory.
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Price <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" name="price" class="form-control"
                                                    value="{{ old('price') }}" placeholder="0.00" required>
                                            </div>
                                        </div>

                                        <!-- Stock -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Stock Quantity <span class="text-danger">*</span></label>
                                                <input type="number" name="stock" class="form-control"
                                                    value="{{ old('stock', 0) }}" placeholder="0" required>
                                            </div>
                                        </div>

                                        <!-- Product Tag / Is Featured -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Product Tag / Type <span class="text-danger">*</span></label>
                                                <select name="is_futured" class="form-control">
                                                    <option value="0" {{ old('is_futured') == '0' ? 'selected' : '' }}>Normal
                                                        Product</option>
                                                    <option value="1" {{ old('is_futured') == '1' ? 'selected' : '' }}>Futured
                                                        Product</option>
                                                    <option value="2" {{ old('is_futured') == '2' ? 'selected' : '' }}>New
                                                        Product</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Multiple Product Images -->

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Product Images (Multiple Allowed)</label>

                                                <!-- File Input -->
                                                <input type="file" name="images[]" id="product_images" class="form-control"
                                                    multiple accept="image/*" onchange="previewSelectedImages(this)">

                                                <!-- Image Count Badge -->
                                                <div class="mt-2">
                                                    <span id="image_count" class="badge badge-info p-2"
                                                        style="display: none; font-size: 13px;"></span>
                                                </div>

                                                <!-- Thumbnails Preview Container -->
                                                <div id="image_preview_container"
                                                    class="d-flex flex-wrap mt-2 p-2 border rounded bg-light"
                                                    style="min-height: 90px; display: none;"></div>
                                            </div>
                                        </div>

                                        <!-- Variants -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Variants (e.g. Size: S, M, L | Color: Red, Blue)</label>
                                                <textarea name="variants" class="form-control" rows="2"
                                                    placeholder="Enter Product Variants">{{ old('variants') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Specification -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Specification</label>

                                                <textarea name="specification"
                                                    class="summernote">{{ old('specification') }}</textarea>

                                                @error('specification')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Meta Title -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    value="{{ old('meta_title') }}" placeholder="Enter Meta Title">
                                            </div>
                                        </div>

                                        <!-- Meta Keywords -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Keywords</label>
                                                <textarea name="meta_keywords" class="form-control" rows="2"
                                                    placeholder="Enter Meta Keywords">{{ old('meta_keywords') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Meta Description / Meta Ads -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Description / Meta Ads</label>
                                                <textarea name="meta_description" class="form-control" rows="3"
                                                    placeholder="Enter Meta Description or Ad Copy">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body text-right">
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="zmdi zmdi-save"></i> Save Product
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
@push('styles')
<link rel="stylesheet"
      href="{{ asset('assets/admin/plugins/summernote/dist/summernote.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/admin/plugins/summernote/dist/summernote.js') }}"></script>

<script>
    $(document).ready(function () {

        // ===================== SUMMERNOTE =====================
        $('.summernote').summernote({
            height: 250,
            placeholder: 'Enter detailed product specifications...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

    });
</script>
@endpush
<script>
    // Global DataTransfer Object to store selected files dynamically
    var selectedFiles = new DataTransfer();

    function previewSelectedImages(input) {
        var container = document.getElementById('image_preview_container');

        // Add newly selected files to DataTransfer
        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(function (file) {
                selectedFiles.items.add(file);
            });
            // Update input files with new list
            input.files = selectedFiles.files;
        }

        renderPreviews();
    }

    function renderPreviews() {
        var input = document.getElementById('product_images');
        var container = document.getElementById('image_preview_container');
        var countBadge = document.getElementById('image_count');

        container.innerHTML = '';

        if (selectedFiles.files.length > 0) {
            countBadge.style.display = 'inline-block';
            countBadge.innerText = 'Total Selected Images: ' + selectedFiles.files.length;
            container.style.display = 'flex';

            Array.from(selectedFiles.files).forEach(function (file, index) {
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        var thumbWrapper = document.createElement('div');
                        thumbWrapper.className = 'm-1 p-1 border rounded bg-white text-center position-relative';
                        thumbWrapper.style.width = '85px';

                        thumbWrapper.innerHTML = `
                            <!-- Red Cross Button -->
                            <button type="button"
                                    onclick="removeImage(${index})"
                                    class="btn btn-danger btn-sm p-0 position-absolute"
                                    style="top: -6px; right: -6px; width: 20px; height: 20px; border-radius: 50%; font-size: 12px; line-height: 18px; font-weight: bold;"
                                    title="Remove image">
                                &times;
                            </button>

                            <!-- Thumbnail Image -->
                            <img src="${e.target.result}" style="width: 75px; height: 75px; object-fit: cover;" class="img-thumbnail mt-1">
                        `;

                        container.appendChild(thumbWrapper);
                    };

                    reader.readAsDataURL(file);
                }
            });
        } else {
            countBadge.style.display = 'none';
            container.style.display = 'none';
        }
    }

    // Function to remove selected image by index
    function removeImage(index) {
        var dt = new DataTransfer();
        var files = selectedFiles.files;

        for (var i = 0; i < files.length; i++) {
            if (i !== index) {
                dt.items.add(files[i]); // Keep all files except the deleted one
            }
        }

        selectedFiles = dt;
        document.getElementById('product_images').files = selectedFiles.files; // Update form input files
        renderPreviews(); // Re-render preview grid & badge count
    }
</script>
