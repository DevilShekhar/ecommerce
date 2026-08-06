@extends('layouts.app')

@section('title', 'Branch Management')

@section('content')
    <section class="content">
        <div class="body_scroll">

            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Branch Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Branches</li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('branches.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Branch
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
                                <h2><strong>Branch</strong> List</h2>
                            </div>

                            <div class="body">

                                <div class="table-responsive">

                                    <table
                                        class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                        <thead>
                                            <tr>
                                                <th width="50">#</th>
                                                <th>Branch Name</th>
                                                <th>Branch Code</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th width="150">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($branches as $key => $branch)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $branch->name }}</td>
                                                    <td>{{ $branch->branch_code ?? '-' }}</td>
                                                    <td>{{ $branch->address ?? '-' }}</td>
                                                    <td>
                                                        @if($branch->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $branch->created_at ? $branch->created_at->format('d M Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        {{-- Edit --}}
                                                        <a href="{{ route('branches.edit', $branch->id) }}"
                                                            class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>

                                                        {{-- Delete / Inactivate --}}
                                                        <form action="{{ route('branches.destroy', $branch->id) }}"
                                                            method="POST" class="delete-form" style="display:inline-block">

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
                                                    <td colspan="7" class="text-center">
                                                        No branches found.
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
