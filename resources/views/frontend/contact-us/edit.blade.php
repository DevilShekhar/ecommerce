@extends('layouts.app')
@section('title', 'Edit Contact Us')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Edit Contact Us</h2>
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
                                Edit Contact Us
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
                <form method="POST" action="{{ route('admin.contact-us.update', $contact->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Edit</strong>
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
                                                    value="{{ old('contact_sub_title', $contact->contact_sub_title) }}"
                                                    placeholder="Enter Contact Sub Title">
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
                                                    value="{{ old('contact_title', $contact->contact_title) }}"
                                                    placeholder="Enter Contact Title">
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
                                                    class="form-control summernote"
                                                    rows="10">{{ old('contact_description', $contact->contact_description) }}</textarea>
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
                                                <input type="text" name="contact_phone" class="form-control"
                                                    value="{{ old('contact_phone', $contact->contact_phone) }}"
                                                    placeholder="Enter Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="contact_email" class="form-control"
                                                    value="{{ old('contact_email', $contact->contact_email) }}"
                                                    placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>WhatsApp Number</label>
                                                <input type="text" name="contact_whatsapp_no" class="form-control"
                                                    value="{{ old('contact_whatsapp_no', $contact->contact_whatsapp_no) }}"
                                                    placeholder="Enter WhatsApp Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="contact_address" class="form-control" rows="3"
                                                    placeholder="Enter Address">{{ old('contact_address', $contact->contact_address) }}</textarea>
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
                                    @if($contact->contact_image)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $contact->contact_image) }}" alt="Contact Us"
                                                style="width:200px;height:120px;object-fit:cover;border-radius:6px;">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label>Contact Us Image</label>
                                        <input type="file" name="contact_image" class="form-control-file"
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
                                    <div class="checkbox">
                                        <input id="contact_status" type="checkbox" name="status" value="1" {{ old('status', $contact->status) ? 'checked' : '' }}>
                                        <label for="contact_status">Active</label>
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
                                        Update Contact Us
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