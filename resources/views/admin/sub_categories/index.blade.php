@can('sub_categories-index')
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
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th width="60">SrNo.</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Meta Title</th>
                                <th>Meta Keywords</th>
                                <th>Meta Description</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($subcategories as $key => $subcategory)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $subcategory->category->name ?? '-' }}</td>
                                    <td>{{ $subcategory->name }}</td>

                                    {{-- Meta Title with hover --}}
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;" title="{{ $subcategory->meta_title ?? '-' }}">
                                            {{ $subcategory->meta_title ?? '-' }}
                                        </div>
                                    </td>

                                    {{-- Meta Keywords with hover --}}
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;" title="{{ $subcategory->meta_keywords ?? '-' }}">
                                            {{ $subcategory->meta_keywords ?? '-' }}
                                        </div>
                                    </td>

                                    {{-- Meta Description with hover --}}
                                    <td>
                                        <div class="text-truncate" style="max-width: 180px;" title="{{ $subcategory->meta_description ?? '-' }}">
                                            {{ $subcategory->meta_description ?? '-' }}
                                        </div>
                                    </td>

                                    <td>{{ $subcategory->creator->name ?? '-' }}</td>

                                    <td>
                                        <span class="badge {{ $subcategory->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $subcategory->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('sub_categories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>


                                        <form action="{{ route('sub_categories.destroy', $subcategory->id) }}" method="POST" class="d-inline delete-form" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')

                                            @if ($subcategory->status==1)
                                            <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                              @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
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
@else
    @php
        abort(403);
    @endphp
@endcan
