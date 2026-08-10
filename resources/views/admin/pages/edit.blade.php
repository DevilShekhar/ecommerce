{{-- @can('pages-edit') --}}
@extends('layouts.app')

@section('title', 'Edit Page')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Edit Page</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.pages.index') }}">Pages</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Page
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
                    </a>
                </div>

            </div>
        </div>

        <div class="container-fluid">

            <form method="POST" action="{{ route('admin.pages.update', $page) }}">
                @csrf
                @method('PUT')

                <div class="row clearfix">

                    <!-- Page Details -->
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="header">
                                <h2><strong>Edit</strong> Page</h2>
                            </div>

                            <div class="body">
                                <div class="row">

                                    <!-- Page Title -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Page Title
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                   name="title"
                                                   class="form-control @error('title') is-invalid @enderror"
                                                   placeholder="Enter Page Title"
                                                   value="{{ old('title', $page->title) }}">

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Slug -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Slug
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                   name="slug"
                                                   class="form-control @error('slug') is-invalid @enderror"
                                                   placeholder="about-us"
                                                   value="{{ old('slug', $page->slug) }}">

                                            @error('slug')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>

                                            <div class="mt-2">
                                                <div class="checkbox">
                                                    <input type="checkbox"
                                                           name="status"
                                                           id="status"
                                                           value="1"
                                                           {{ old('status', $page->status) ? 'checked' : '' }}>
                                                    <label for="status">Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- SEO Details -->
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="header">
                                <h2><strong>SEO</strong> Details</h2>
                            </div>

                            <div class="body">
                                <div class="row">

                                    <!-- Meta Title -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Title</label>

                                            <input type="text"
                                                   name="meta_title"
                                                   class="form-control @error('meta_title') is-invalid @enderror"
                                                   placeholder="Enter Meta Title"
                                                   value="{{ old('meta_title', $page->meta_title) }}">

                                            @error('meta_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Description</label>

                                            <textarea name="meta_description"
                                                      rows="4"
                                                      class="form-control @error('meta_description') is-invalid @enderror"
                                                      placeholder="Enter Meta Description">{{ old('meta_description', $page->meta_description) }}</textarea>

                                            @error('meta_description')
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

                    <!-- Action Buttons -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">

                                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Update Page
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

{{-- @else
@php
    abort(403);
@endphp
@endcan --}}
