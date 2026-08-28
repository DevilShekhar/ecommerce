@extends('layouts.app')
@section('title', 'Edit Terms & Conditions')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Edit Terms & Conditions</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.terms-conditions.index') }}">
                                Terms & Conditions
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Terms & Conditions
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.terms-conditions.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form id="terms-conditions-edit-form" action="{{ route('admin.terms-conditions.update', $termsConditions->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div id="terms-conditions-wrapper">
                    <div class="terms-condition-item" data-index="0">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2>
                                                    <strong>Terms & Conditions</strong>
                                                    #<span class="item-number">1</span>
                                                </h2>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="button" class="btn btn-danger btn-sm remove-item" style="display:none;">
                                                    <i class="zmdi zmdi-delete"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <input type="text" name="items[0][terms_conditions_category]"
                                                        class="form-control @error('items.0.terms_conditions_category') is-invalid @enderror"
                                                        value="{{ old('items.0.terms_conditions_category', $termsConditions->terms_conditions_category) }}"
                                                        placeholder="Example: Terms & Conditions">
                                                    @error('items.0.terms_conditions_category')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sub Title</label>
                                                    <input type="text" name="items[0][terms_conditions_subtitle]"
                                                        class="form-control @error('items.0.terms_conditions_subtitle') is-invalid @enderror"
                                                        value="{{ old('items.0.terms_conditions_subtitle', $termsConditions->terms_conditions_subtitle) }}"
                                                        placeholder="Enter sub title">
                                                    @error('items.0.terms_conditions_subtitle')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="items[0][terms_conditions_title]"
                                                        class="form-control @error('items.0.terms_conditions_title') is-invalid @enderror"
                                                        value="{{ old('items.0.terms_conditions_title', $termsConditions->terms_conditions_title) }}"
                                                        placeholder="Enter Terms & Conditions title" required>
                                                    @error('items.0.terms_conditions_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description <span class="text-danger">*</span></label>
                                                    <textarea name="items[0][terms_conditions_descripton]"
                                                        class="summernote @error('items.0.terms_conditions_descripton') is-invalid @enderror">{{ old('items.0.terms_conditions_descripton', $termsConditions->terms_conditions_descripton) }}</textarea>
                                                    @error('items.0.terms_conditions_descripton')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Section</strong>
                                            Image
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Current Image</label>
                                                    @if($termsConditions->terms_conditions_iamage)
                                                        <div class="mb-2">
                                                            <img src="{{ asset('storage/' . $termsConditions->terms_conditions_iamage) }}"
                                                                alt="{{ $termsConditions->terms_conditions_title }}"
                                                                width="150" height="100" style="object-fit: cover; border-radius: 5px;">
                                                        </div>
                                                    @else
                                                        <p class="text-muted">No image uploaded</p>
                                                    @endif
                                                    <label>Change Image</label>
                                                    <input type="file" name="items[0][terms_conditions_iamage]"
                                                        class="form-control @error('items.0.terms_conditions_iamage') is-invalid @enderror"
                                                        accept=".jpg,.jpeg,.png,.webp">
                                                    <small class="form-text text-muted">
                                                        JPG, JPEG, PNG or WEBP. Maximum 2MB. Leave empty to keep current image.
                                                    </small>
                                                    @error('items.0.terms_conditions_iamage')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Page</strong>
                                            Status
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input type="checkbox" name="items[0][status]" value="1"
                                                    {{ old('items.0.status', $termsConditions->status ?? 1) ? 'checked' : '' }}>
                                                <label>Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('admin.terms-conditions.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="zmdi zmdi-update"></i>
                                    Update All Terms & Conditions
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
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/dist/summernote.css') }}">
<style>
    .terms-condition-item {
        margin-bottom: 30px;
        border: 1px solid #e8e8e8;
        border-radius: 8px;
        padding: 10px;
        background: #f9f9f9;
        position: relative;
    }
    .terms-condition-item .card {
        margin-bottom: 0;
        border: none;
        box-shadow: none;
    }
    .terms-condition-item .card .header {
        border-bottom: 1px solid #e8e8e8;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .remove-item {
        margin-top: 5px;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/admin/plugins/summernote/dist/summernote.js') }}"></script>
<script>
    $(document).ready(function() {
        let itemCount = 1;

        // Initialize summernote for existing items
        $('.summernote').each(function() {
            $(this).summernote({
                height: 300,
                placeholder: 'Write Terms & Conditions content...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic', 'strikethrough', 'superscript', 'subscript']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        function initializeSummernote(element) {
            element.summernote({
                height: 300,
                placeholder: 'Write Terms & Conditions content...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic', 'strikethrough', 'superscript', 'subscript']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }
        function updateItemNumbers() {
            $('.terms-condition-item').each(function(index) {
                $(this).find('.item-number').text(index + 1);
                $(this).attr('data-index', index);
                // Update name attributes
                $(this).find('input, textarea, select').each(function() {
                    const name = $(this).attr('name');
                    if (name) {
                        const newName = name.replace(/items\[\d+\]/, `items[${index}]`);
                        $(this).attr('name', newName);
                    }
                });
            });
        }

        // Show remove button if more than one item exists on load
        if ($('.terms-condition-item').length > 1) {
            $('.remove-item').show();
        } else {
            $('.remove-item').hide();
        }
    });
</script>
@endpush
