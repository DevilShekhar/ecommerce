@extends('layouts.app')

@section('title', 'Warehouse Management')

@section('content')
<section class="content">
    <div class="body_scroll">

        <!-- Block Header -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Warehouse Management</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Warehouses</li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('warehouses.create') }}" class="btn btn-primary btn-round">
                        <i class="zmdi zmdi-plus"></i> Add Warehouse
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

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row clearfix">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">
                            <h2><strong>Warehouse</strong> List</h2>
                        </div>

                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Code</th>
                                            <th>Warehouse Name</th>
                                            <th>Branch</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($warehouses as $key => $warehouse)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><strong>{{ $warehouse->warehouse_code }}</strong></td>
                                                <td>{{ $warehouse->warehouse_name }}</td>
                                                <td>{{ $warehouse->branch->name ?? '-' }}</td>
                                                <td>{{ $warehouse->phone ?? '-' }}</td>
                                                <td>{{ $warehouse->city ?? '-' }}</td>
                                                <td>
                                                    @if($warehouse->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- Edit --}}
                                                    <a href="{{ route('warehouses.edit', $warehouse->id) }}"
                                                       class="btn btn-warning btn-sm"
                                                       title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>

                                                    {{-- Delete / Inactivate --}}
                                                    <form action="{{ route('warehouses.destroy', $warehouse->id) }}"
                                                          method="POST"
                                                          style="display:inline-block"
                                                          onsubmit="return confirm('Are you sure you want to delete this warehouse?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    No warehouses found.
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