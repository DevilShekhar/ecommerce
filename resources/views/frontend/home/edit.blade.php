@extends('layouts.app')
@section('title', 'Edit Home Section')
@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Edit Home Section</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.sections.index') }}">Home Sections</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Home Section</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form id="home-section-edit-form" method="POST" action="{{ route('admin.sections.update', $homeSection->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Edit</strong> Home Section</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Title</label>
                                            <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" placeholder="Enter Home Section Sub Title" value="{{ old('subtitle', $homeSection->subtitle) }}">
                                            @error('subtitle')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Home Section Title" value="{{ old('title', $homeSection->title) }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Home Section Description...">{{ old('description', $homeSection->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($homeSection->image)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Image</label>
                                                <div>
                                                    <img src="{{ asset('storage/' . $homeSection->image) }}" alt="{{ $homeSection->title }}" style="width:180px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;padding:3px;">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Section Image</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/png,image/jpeg,image/jpg,image/webp">
                                            <small class="text-muted">Leave empty to keep the current image. JPG, JPEG, PNG or WEBP. Maximum 2MB.</small>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
                                <h2><strong>Section</strong> Status</h2>
                            </div>
                            <div class="body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="checkbox">
                                        <input type="hidden" name="status" value="0">
                                        <input id="status" type="checkbox" name="status" value="1" {{ old('status', $homeSection->status) ? 'checked' : '' }}>
                                        <label for="status">Active</label>
                                    </div>
                                    <small class="text-muted">Active sections will be displayed on the public Home page.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('admin.sections.index') }}" class="btn btn-secondary">
                                    <i class="zmdi zmdi-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i> Update Home Section
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