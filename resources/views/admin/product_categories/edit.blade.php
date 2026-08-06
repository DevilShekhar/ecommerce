@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6">
                    <h2>Edit Category</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('product_categories.index') }}">
                                Product Categories
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Category
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 text-right">
                    <a href="{{ route('product_categories.index') }}"
                        class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
                    </a>
                </div>

            </div>
        </div>

        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                action="{{ route('product_categories.update',$productCategory->id) }}">

                @csrf
                @method('PUT')

                <div class="row clearfix">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">
                                <h2><strong>Edit</strong> Category</h2>
                            </div>

                            <div class="body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>
                                                Category Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text"
                                                name="name"
                                                class="form-control"
                                                value="{{ old('name',$productCategory->name) }}">
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Status</label>

                                            <select name="status"
                                                class="form-control">

                                                <option value="1"
                                                    {{ old('status',$productCategory->status)==1 ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0"
                                                    {{ old('status',$productCategory->status)==0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Description</label>

                                            <textarea
                                                name="description"
                                                rows="4"
                                                class="form-control">{{ old('description',$productCategory->description) }}</textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="body text-right">

                                <a href="{{ route('product_categories.index') }}"
                                    class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Update Category
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
