@extends('layouts.app')
@section('title', 'Edit Privacy Policy')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Edit Privacy Policy</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.privacy-policies.index') }}">Privacy Policy</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Privacy Policy</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.privacy-policies.index') }}" class="btn btn-danger"><i
                                class="zmdi zmdi-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form method="POST" action="{{ route('admin.privacy-policies.update', $privacyPolicy) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Edit</strong> Privacy Policy</h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub Title</label>
                                                <input type="text" name="privacy_policy_subtitle"
                                                    class="form-control @error('privacy_policy_subtitle') is-invalid @enderror"
                                                    placeholder="Enter Privacy Policy Sub Title"
                                                    value="{{ old('privacy_policy_subtitle', $privacyPolicy->privacy_policy_subtitle) }}">
                                                @error('privacy_policy_subtitle')<span
                                                class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" name="privacy_policy_title"
                                                    class="form-control @error('privacy_policy_title') is-invalid @enderror"
                                                    placeholder="Enter Privacy Policy Title"
                                                    value="{{ old('privacy_policy_title', $privacyPolicy->privacy_policy_title) }}"
                                                    required>
                                                @error('privacy_policy_title')<span
                                                class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea name="privacy_policy_description" id="privacy_policy_description"
                                                    class="summernote @error('privacy_policy_description') is-invalid @enderror">{{ old('privacy_policy_description', $privacyPolicy->privacy_policy_description) }}</textarea>
                                                @error('privacy_policy_description')<small
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
                                                @if($privacyPolicy->privacy_policy_image)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/' . $privacyPolicy->privacy_policy_image) }}"
                                                            alt="Privacy Policy Image"
                                                            style="max-width:200px;height:120px;object-fit:cover;border-radius:8px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="privacy_policy_image"
                                                    class="form-control @error('privacy_policy_image') is-invalid @enderror"
                                                    accept=".jpg,.jpeg,.png,.webp">
                                                <small class="form-text text-muted">JPG, JPEG, PNG or WEBP. Maximum
                                                    2MB.</small>
                                                @error('privacy_policy_image')<span
                                                class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
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
                                            <input id="privacy_policy_status" type="checkbox" name="status" value="1" {{ old('status', $privacyPolicy->status) ? 'checked' : '' }}>
                                            <label for="privacy_policy_status">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body text-right">
                                    <a href="{{ route('admin.privacy-policies.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success"><i class="zmdi zmdi-save"></i> Update
                                        Privacy Policy</button>
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
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('assets/admin/plugins/summernote/dist/summernote.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#privacy_policy_description').summernote({
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
    </script>
@endpush
