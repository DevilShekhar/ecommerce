@extends('layouts.app')

@section('title', 'Sub Categories')

@section('content')

    <section class="content">
        <div class="body_scroll">

            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Sub Categories</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Sub Categories
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('sub_categories.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i>
                            Add Sub Category
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="card">
                    <div class="header">
                        <h2><strong>Sub Category</strong> List</h2>
                    </div>

                    <div class="body table-responsive">

                        <table id="datatable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Status</th>
                                    <th width="160">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($subcategories as $key => $subcategory)

                                    <tr>

                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            {{ $subcategory->category->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $subcategory->name }}
                                        </td>
                                        <td>
                                            {{ $subcategory->status ? 'Active' : 'Inactive' }}
                                        </td>

                                        <td>

                                            <a href="{{ route('sub_categories.edit', $subcategory->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>

                                            <form action="{{ route('sub_categories.destroy', $subcategory->id) }}" method="POST"
                                                class="d-inline delete-form" style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No Record Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
