@extends('layouts.app')

@section('title', 'View Brand')

@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>View Brand</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('brands.index') }}">
                                    Brands
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                View Brand
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('brands.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <!-- Brand Information -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>Brand</strong> Information
                                </h2>
                            </div>
                            <div class="body">

                                <table class="table table-bordered">
                                    <tr>
                                        <th width="220">Category</th>
                                        <td>{{ $brand->category->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub Category</th>
                                        <td>{{ $brand->subCategory->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Brand Code</th>
                                        <td>{{ $brand->brand_code ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Brand Name</th>
                                        <td>{{ $brand->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>{{ optional($brand->createdBy)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>{{ optional($brand->updatedBy)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>
                                            {{ $brand->created_at ? $brand->created_at->format('d M Y h:i A') : '-' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- SEO Information -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>SEO</strong> Information
                                </h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="220">Meta Title</th>
                                        <td>{{ $brand->meta_title ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Keywords</th>
                                        <td>{{ $brand->meta_keyword ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Description</th>
                                        <td>{{ $brand->meta_ads ?: '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Audit Information -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>Audit</strong> Information
                                </h2>
                            </div>
                            <div class="body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="220">Created By</th>
                                        <td>{{ optional($brand->createdBy)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th width="220">Updated By</th>
                                        <td>{{ optional($brand->updatedBy)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>
                                            {{ $brand->created_at ? $brand->created_at->format('d M Y h:i A') : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated</th>
                                        <td>
                                            {{ $brand->updated_at ? $brand->updated_at->format('d M Y h:i A') : '-' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Back Button -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                    <i class="zmdi zmdi-arrow-left"></i>
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
