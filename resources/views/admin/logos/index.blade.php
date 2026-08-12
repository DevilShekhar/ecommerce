
@extends('layouts.app')

@section('title', 'Logo & Favicon')

@section('content')

<section class="content">
    <div class="body_scroll">
    <div class="block-header">
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Logo & Favicon</h2>

                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="zmdi zmdi-home"></i> Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Logo & Favicon
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="row clearfix">

            <div class="col-lg-12">

                <div class="card">

                    <div class="header">
                        <h2>
                            <strong>Website</strong> Logo & Favicon
                        </h2>
                    </div>

                    <div class="body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Uploaded</strong> Logo & Favicon
                                        </h2>
                                    </div>

                                    <div class="body">

                                        <div class="form-group">
                                            <label>
                                                Website Logo
                                            </label>

                                            <div class="border rounded p-3 text-center"
                                                 style="min-height:120px;display:flex;align-items:center;justify-content:center;">

                                                @if($logo?->logo)

                                                    <img
                                                        src="{{ asset('storage/' . $logo->logo) }}"
                                                        alt="Website Logo"
                                                        style="width:180px;height:70px;object-fit:contain;"
                                                    >

                                                @else

                                                    <span class="text-muted">
                                                        No logo uploaded
                                                    </span>

                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group mt-4">

                                            <label>
                                                Favicon
                                            </label>

                                            <div class="border rounded p-3 text-center"
                                                 style="min-height:100px;display:flex;align-items:center;justify-content:center;">

                                                @if($logo?->favicon)

                                                    <img
                                                        src="{{ asset('storage/' . $logo->favicon) }}"
                                                        alt="Favicon"
                                                        style="width:64px;height:64px;object-fit:contain;"
                                                    >

                                                @else

                                                    <span class="text-muted">
                                                        No favicon uploaded
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="card">

                                    <div class="header">
                                        <h2>
                                            <strong>Update</strong> Logo & Favicon
                                        </h2>
                                    </div>

                                    <div class="body">

                                        <form action="{{ route('logos.update') }}"
                                              method="POST"
                                              enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-group">

                                                <label>
                                                    Website Logo
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="file"
                                                    name="logo"
                                                    class="form-control @error('logo') is-invalid @enderror"
                                                    accept="image/png,image/jpeg,image/jpg,image/webp,image/svg+xml"
                                                >

                                                @error('logo')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <small class="form-text text-muted">
                                                    Recommended size: 180 × 50 px
                                                </small>

                                            </div>

                                            <div class="form-group mt-4">

                                                <label>
                                                    Favicon
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input
                                                    type="file"
                                                    name="favicon"
                                                    class="form-control @error('favicon') is-invalid @enderror"
                                                    accept=".ico,.png,.jpg,.jpeg,.webp"
                                                >

                                                @error('favicon')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <small class="form-text text-muted">
                                                    Recommended size: 32 × 32 px
                                                </small>

                                            </div>

                                            <div class="text-right mt-4">

                                                <button type="submit"
                                                        class="btn btn-success">
                                                    <i class="zmdi zmdi-save"></i>
                                                    Update Logo
                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
</section>
@endsection
