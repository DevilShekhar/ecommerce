@extends('layouts.app')
@section('title', 'Edit About Us')
@section('content')
    <section class="content">
        <div class="body_scroll">
            {{-- =====================================================
            PAGE HEADER
            ====================================================== --}}
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Edit About Us</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            {{-- <li class="breadcrumb-item">
                                <a href="{{ route('about-us.index') }}">
                                    About Us
                                </a>
                            </li> --}}
                            <li class="breadcrumb-item active">
                                Edit About Us
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        {{-- <a href="{{ route('about-us.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a> --}}
                    </div>
                </div>
            </div>
            {{-- =====================================================
            FORM
            ====================================================== --}}
            <div class="container-fluid">
                <form id="about-us-edit-form" method="POST" action="{{ route('admin.about-us.update', $aboutUs->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row clearfix">
                        {{-- =====================================================
                        ABOUT US SECTION
                        ====================================================== --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>About</strong> Us
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        {{-- Sub Title --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Sub Title
                                                </label>
                                                <input type="text" name="about_sub_title"
                                                    class="form-control @error('about_sub_title') is-invalid @enderror"
                                                    placeholder="Enter About Us Sub Title"
                                                    value="{{ old('about_sub_title', $aboutUs->about_sub_title) }}">
                                                @error('about_sub_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Title --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="about_title"
                                                    class="form-control @error('about_title') is-invalid @enderror"
                                                    placeholder="Enter About Us Title"
                                                    value="{{ old('about_title', $aboutUs->about_title) }}">
                                                @error('about_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Description --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Content / Description
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea name="about_description" rows="6"
                                                    class="form-control @error('about_description') is-invalid @enderror"
                                                    placeholder="Enter About Us Description...">{{ old('about_description', $aboutUs->about_description) }}</textarea>
                                                @error('about_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Image --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Section Image
                                                </label>
                                                @if($aboutUs->about_image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $aboutUs->about_image) }}"
                                                            alt="Current About Image" width="120" height="90"
                                                            style="object-fit:cover;border-radius:6px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="about_image"
                                                    class="form-control @error('about_image') is-invalid @enderror"
                                                    accept="image/png,image/jpeg,image/jpg,image/webp">
                                                <small class="text-muted">
                                                    JPG, JPEG, PNG or WEBP. Maximum 2MB. Leave empty to keep current image.
                                                </small>
                                                @error('about_image')
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
                        {{-- =====================================================
                        OUR MISSION SECTION
                        ====================================================== --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Our</strong> Mission
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        {{-- Mission Sub Title --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Sub Title
                                                </label>
                                                <input type="text" name="mission_sub_title"
                                                    class="form-control @error('mission_sub_title') is-invalid @enderror"
                                                    placeholder="Enter Mission Sub Title"
                                                    value="{{ old('mission_sub_title', $aboutUs->mission_sub_title) }}">
                                                @error('mission_sub_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Mission Title --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mission_title"
                                                    class="form-control @error('mission_title') is-invalid @enderror"
                                                    placeholder="Enter Mission Title"
                                                    value="{{ old('mission_title', $aboutUs->mission_title) }}">
                                                @error('mission_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Mission Description --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Description
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea name="mission_description" rows="6"
                                                    class="form-control @error('mission_description') is-invalid @enderror"
                                                    placeholder="Enter Mission Description...">{{ old('mission_description', $aboutUs->mission_description) }}</textarea>
                                                @error('mission_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Mission Image --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Image
                                                </label>
                                                @if($aboutUs->mission_image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $aboutUs->mission_image) }}"
                                                            alt="Current Mission Image" width="120" height="90"
                                                            style="object-fit:cover;border-radius:6px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="mission_image"
                                                    class="form-control @error('mission_image') is-invalid @enderror"
                                                    accept="image/png,image/jpeg,image/jpg,image/webp">
                                                <small class="text-muted">
                                                    JPG, JPEG, PNG or WEBP. Maximum 2MB. Leave empty to keep current image.
                                                </small>
                                                @error('mission_image')
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
                        {{-- =====================================================
                        OUR VISION SECTION
                        ====================================================== --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Our</strong> Vision
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        {{-- Vision Sub Title --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Sub Title
                                                </label>
                                                <input type="text" name="vision_sub_title"
                                                    class="form-control @error('vision_sub_title') is-invalid @enderror"
                                                    placeholder="Enter Vision Sub Title"
                                                    value="{{ old('vision_sub_title', $aboutUs->vision_sub_title) }}">
                                                @error('vision_sub_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Vision Title --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="vision_title"
                                                    class="form-control @error('vision_title') is-invalid @enderror"
                                                    placeholder="Enter Vision Title"
                                                    value="{{ old('vision_title', $aboutUs->vision_title) }}">
                                                @error('vision_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Vision Description --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>
                                                    Description
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea name="vision_description" rows="6"
                                                    class="form-control @error('vision_description') is-invalid @enderror"
                                                    placeholder="Enter Vision Description...">{{ old('vision_description', $aboutUs->vision_description) }}</textarea>
                                                @error('vision_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>
                                                            {{ $message }}
                                                        </strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Vision Image --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    Image
                                                </label>
                                                @if($aboutUs->vision_image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $aboutUs->vision_image) }}"
                                                            alt="Current Vision Image" width="120" height="90"
                                                            style="object-fit:cover;border-radius:6px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="vision_image"
                                                    class="form-control @error('vision_image') is-invalid @enderror"
                                                    accept="image/png,image/jpeg,image/jpg,image/webp">
                                                <small class="text-muted">
                                                    JPG, JPEG, PNG or WEBP. Maximum 2MB. Leave empty to keep current image.
                                                </small>
                                                @error('vision_image')
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
                        {{-- =====================================================
                        STATUS
                        ====================================================== --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Page</strong> Status
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="form-group">
                                        <label>
                                            Status
                                        </label>
                                        <div class="checkbox">
                                            <input type="hidden" name="status" value="0">
                                            <input id="status" type="checkbox" name="status" value="1" {{ old('status', $aboutUs->status) ? 'checked' : '' }}>
                                            <label for="status">
                                                Active
                                            </label>
                                        </div>
                                        <small class="text-muted">
                                            Active content will be displayed on the public About Us page.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- =====================================================
                        BUTTONS
                        ====================================================== --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body text-right">
                                    {{-- <a href="{{ route('about-us.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a> --}}
                                    <button type="submit" class="btn btn-success">
                                        <i class="zmdi zmdi-save"></i>
                                        Update About Us
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
