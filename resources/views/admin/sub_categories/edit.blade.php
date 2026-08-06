@extends('layouts.app')

@section('title', 'Edit Sub Category')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <h2>Edit Sub Category</h2>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('sub_categories.index') }}">
                                Sub Categories
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit
                        </li>

                    </ul>

                </div>

                <div class="col-lg-6 text-right">

                    <a href="{{ route('sub_categories.index') }}" class="btn btn-danger">
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
                  action="{{ route('sub_categories.update',$sub_category->id) }}">

                @csrf
                @method('PUT')

                <div class="row clearfix">

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">
                                <h2><strong>Edit</strong> Sub Category</h2>
                            </div>

                            <div class="body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Category
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select
                                                name="category_id"
                                                class="form-control">

                                                @foreach($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        {{ old('category_id',$sub_category->category_id)==$category->id ? 'selected' : '' }}>

                                                        {{ $category->name }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Sub Category Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                value="{{ old('name',$sub_category->name) }}"
                                                placeholder="Enter Sub Category Name">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="body text-right">

                                <a href="{{ route('sub_categories.index') }}"
                                   class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button class="btn btn-success">

                                    <i class="zmdi zmdi-save"></i>

                                    Update Sub Category

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