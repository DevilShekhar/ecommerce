@extends('layouts.app')

@section('title', 'Edit Disclaimer')

    @section('content')

        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2>Edit Disclaimer</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="zmdi zmdi-home"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.disclaimers.index') }}">Disclaimers</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Edit Disclaimer
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                            <a href="{{ route('admin.disclaimers.index') }}" class="btn btn-danger">
                                <i class="zmdi zmdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <form method="POST" action="{{ route('admin.disclaimers.update', $disclaimer->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="header">
                                        <h2><strong>Edit</strong> Disclaimer</h2>
                                    </div>

                                    <div class="body">
                                        <div class="row">

                                            {{-- Sub Title --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sub Title</label>
                                                    <input type="text" name="subtitle"
                                                        class="form-control @error('subtitle') is-invalid @enderror"
                                                        placeholder="Enter Disclaimer Sub Title"
                                                        value="{{ old('subtitle', $disclaimer->subtitle) }}">
                                                    @error('subtitle')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Title --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title <span class="text-danger">*</span></label>
                                                    <input type="text" name="title"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        placeholder="Enter Disclaimer Title"
                                                        value="{{ old('title', $disclaimer->title) }}">
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Description --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description <span class="text-danger">*</span></label>
                                                    <textarea name="description" rows="7"
                                                        class="form-control @error('description') is-invalid @enderror"
                                                        placeholder="Enter Disclaimer Description">{{ old('description', $disclaimer->description) }}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Section Image --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Section Image</label>

                                                    @if($disclaimer->section_image)
                                                        <div class="mb-3">
                                                            <img src="{{ asset($disclaimer->section_image) }}"
                                                                alt="Disclaimer Image"
                                                                style="width:180px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                                                        </div>
                                                    @endif

                                                    <input type="file" name="section_image"
                                                        class="form-control @error('section_image') is-invalid @enderror"
                                                        accept=".jpg,.jpeg,.png,.webp">

                                                    <small class="text-muted">
                                                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                                                    </small>

                                                    @error('section_image')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Status --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{ old('status', $disclaimer->status) == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option value="0" {{ old('status', $disclaimer->status) == 0 ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="body text-right">
                                        <a href="{{ route('admin.disclaimers.index') }}" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            <i class="zmdi zmdi-save"></i>
                                            Update Disclaimer
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
