@extends('layouts.app')
@section('title', 'Add Privacy Policy')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Add Privacy Policy</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.privacy-policies.index') }}">Privacy Policy</a>
                            </li>
                            <li class="breadcrumb-item active">Add Privacy Policy</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.privacy-policies.index') }}" class="btn btn-danger"><i
                                class="zmdi zmdi-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form id="privacy-policy-create-form" action="{{ route('admin.privacy-policies.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="privacy-policy-wrapper">
                        <div class="privacy-policy-item" data-index="0">
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h2><strong>Privacy Policy</strong> #<span class="item-number">1</span>
                                                    </h2>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <button type="button" class="btn btn-danger btn-sm remove-item"
                                                        style="display:none;"><i class="zmdi zmdi-delete"></i>
                                                        Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Sub Title</label>
                                                        <input type="text" name="items[0][privacy_policy_subtitle]"
                                                            class="form-control @error('items.0.privacy_policy_subtitle') is-invalid @enderror"
                                                            value="{{ old('items.0.privacy_policy_subtitle') }}"
                                                            placeholder="Enter Privacy Policy Sub Title">
                                                        @error('items.0.privacy_policy_subtitle')<span
                                                            class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title <span class="text-danger">*</span></label>
                                                        <input type="text" name="items[0][privacy_policy_title]"
                                                            class="form-control @error('items.0.privacy_policy_title') is-invalid @enderror"
                                                            value="{{ old('items.0.privacy_policy_title') }}"
                                                            placeholder="Enter Privacy Policy Title" required>
                                                        @error('items.0.privacy_policy_title')<span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description <span class="text-danger">*</span></label>
                                                        <textarea name="items[0][privacy_policy_description]"
                                                            class="summernote @error('items.0.privacy_policy_description') is-invalid @enderror">{{ old('items.0.privacy_policy_description') }}</textarea>
                                                        @error('items.0.privacy_policy_description')<small
                                                        class="text-danger d-block">{{ $message }}</small>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>Section</strong> Image</h2>
                                        </div>
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Section Image</label>
                                                        <input type="file" name="items[0][privacy_policy_image]"
                                                            class="form-control @error('items.0.privacy_policy_image') is-invalid @enderror"
                                                            accept=".jpg,.jpeg,.png,.webp">
                                                        <small class="form-text text-muted">JPG, JPEG, PNG or WEBP. Maximum
                                                            2MB.</small>
                                                        @error('items.0.privacy_policy_image')<span
                                                            class="invalid-feedback d-block"
                                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2><strong>Page</strong> Status</h2>
                                            </div>
                                            <div class="body">
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="items[0][status]" value="1" {{ old('items.0.status', 1) ? 'checked' : '' }}>
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
                                        <a href="{{ route('admin.privacy-policies.index') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-success"><i class="zmdi zmdi-save"></i> Save
                                            All Privacy Policy</button>
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
        .privacy-policy-item {
            margin-bottom: 30px;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 10px;
            background: #f9f9f9;
            position: relative
        }

        .privacy-policy-item .card {
            margin-bottom: 0;
            border: none;
            box-shadow: none
        }

        .privacy-policy-item .card .header {
            border-bottom: 1px solid #e8e8e8;
            padding-bottom: 10px;
            margin-bottom: 15px
        }

        .remove-item {
            margin-top: 5px
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('assets/admin/plugins/summernote/dist/summernote.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').each(function () {
                $(this).summernote({
                    height: 200,
                    placeholder: 'Write Privacy Policy content...',
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
        });
    </script>
@endpush
