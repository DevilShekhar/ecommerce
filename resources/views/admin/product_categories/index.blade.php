@extends('layouts.app')

@section('title', 'Categories')

@section('content')

    <section class="content">
        <div class="body_scroll">

            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Categories</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Categories
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('product_categories.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i>
                            Add Category
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="header">
                        <h2><strong>Category</strong> List</h2>
                    </div>

                    <div class="body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th width="60">SrNo.</th>
                                        <th>Name</th>
                                        <th>Meta Title</th>
                                        <th>Meta Ads</th>
                                        <th>Meta Keyword</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Status</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($categories as $key => $category)

                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <td>{{ $category->name }}</td>

                                            <td>{{ $category->meta_title ?? '-' }}</td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $category->meta_ads }}">
                                                {{ \Illuminate\Support\Str::words($category->meta_ads ?? '-', 3, '...') }}
                                            </td>
                                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $category->meta_keyword }}">
                                                {{ \Illuminate\Support\Str::words($category->meta_keyword ?? '-', 3, '...') }}
                                            </td>
                                            <td>{{ $category->createdBy->name ?? $category->created_by ?? '-' }}</td>
                                            <td>{{ $category->updatedBy->name ?? $category->updated_by ?? '-' }}</td>

                                            <td>
                                                @if($category->status)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>

                                                <a href="{{ route('product_categories.edit', $category->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                <form action="{{ route('product_categories.destroy', $category->id) }}"
                                                    method="POST" class="d-inline delete-form" style="display:inline-block">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No Categories Found
                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
