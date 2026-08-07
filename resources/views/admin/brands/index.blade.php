@can('brands-index')
@extends('layouts.app')

@section('title', 'Brand Management')

@section('content')
    <section class="content">
        <div class="body_scroll">

            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Brand Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('brands.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Brand
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row clearfix">
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">
                                <h2><strong>Brand</strong> List</h2>
                            </div>

                            <div class="body">

                                <div class="table-responsive">

                                    <table
                                        class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                        <thead>
                                            <tr>
                                                <th width="50">SrNo.</th>
                                                <th>Branch Name</th>
                                                <th>Branch Code</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Created By</th>
                                                <th>Updated By</th>
                                                <th width="150">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($brands as $key => $brand)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $brand->name }}</td>
                                                    <td>{{ $brand->brand_code ?? '-' }}</td>
                                                    <td>
                                                        @if($brand->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $brand->created_at ? $brand->created_at->format('d M Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        {{ optional($brand->createdBy)->name ?? '-' }}
                                                    </td>
                                                    <td>
                                                        {{ optional($brand->updatedBy)->name ?? '-' }}
                                                    <td>
                                                        {{-- Edit --}}
                                                        <a href="{{ route('brands.edit', $brand->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>

                                                        {{-- View --}}
                                                        <a href="{{ route('brands.show', $brand->id) }}"
                                                            class="btn btn-sm btn-info" title="View">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </a>

                                                        {{-- Delete --}}
                                                        @if($brand->status == 1)
                                                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                                                class="d-inline delete-form" data-brand-name="{{ $brand->name }}">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                    title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        No brands found.
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
            </div>
        </div>
    </section>
@endsection
@else
    @php
        abort(403);
    @endphp
@endcan
