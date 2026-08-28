@extends('layouts.app')
@section('title', 'Create Contact Us')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Create Contact Us</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.contact-us.index') }}">
                                    Contact Us
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Create Contact Us
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.contact-us.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form method="POST" action="{{ route('admin.contact-us.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Create</strong>
                                        Contact Us
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sub Title</label>
                                                <input type="text" name="contact_sub_title"
                                                    class="form-control @error('contact_sub_title') is-invalid @enderror"
                                                    placeholder="Enter Contact Sub Title"
                                                    value="{{ old('contact_sub_title') }}">
                                                @error('contact_sub_title')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" name="contact_title"
                                                    class="form-control @error('contact_title') is-invalid @enderror"
                                                    placeholder="Enter Contact Title" value="{{ old('contact_title') }}">
                                                @error('contact_title')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="text-danger">*</span></label>
                                                <textarea name="contact_description" id="contact_description"
                                                    class="form-control summernote @error('contact_description') is-invalid @enderror"
                                                    rows="10"
                                                    placeholder="Enter Contact Us Description">{{ old('contact_description') }}</textarea>
                                                @error('contact_description')
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Contact</strong>
                                        Information
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" name="contact_phone"
                                                    class="form-control @error('contact_phone') is-invalid @enderror"
                                                    placeholder="Enter Phone Number" value="{{ old('contact_phone') }}">
                                                @error('contact_phone')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="contact_email"
                                                    class="form-control @error('contact_email') is-invalid @enderror"
                                                    placeholder="Enter Email Address" value="{{ old('contact_email') }}">
                                                @error('contact_email')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>WhatsApp Number</label>
                                                <input type="text" name="contact_whatsapp_no"
                                                    class="form-control @error('contact_whatsapp_no') is-invalid @enderror"
                                                    placeholder="Enter WhatsApp Number"
                                                    value="{{ old('contact_whatsapp_no') }}">
                                                @error('contact_whatsapp_no')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="contact_address"
                                                    class="form-control @error('contact_address') is-invalid @enderror"
                                                    rows="3"
                                                    placeholder="Enter Address">{{ old('contact_address') }}</textarea>
                                                @error('contact_address')
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Section</strong>
                                        Image
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="form-group">
                                        <label>Contact Us Image</label>
                                        <input type="file" name="contact_image"
                                            class="form-control-file @error('contact_image') is-invalid @enderror"
                                            accept=".jpg,.jpeg,.png,.webp">
                                        <small class="form-text text-muted">
                                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                                        </small>
                                        @error('contact_image')
                                            <span class="invalid-feedback d-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                            <input id="contact_status" type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                            <label for="contact_status">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body text-right">
                                    <a href="{{ route('admin.contact-us.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="zmdi zmdi-save"></i>
                                        Create Contact Us
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
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#contact_description').summernote({
                height: 350,
                minHeight: 250,
                maxHeight: 500,
                focus: false,
                placeholder: 'Enter Contact Us Description...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush