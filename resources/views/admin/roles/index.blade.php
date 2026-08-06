@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Role Management</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <i class="zmdi zmdi-plus"></i> Add Role
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
                            <h2><strong>Role</strong> List</h2>
                        </div>

                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Role Name</th>
                                            <th>Guard</th>
                                            <th>Created At</th>
                                            <th width="200">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($roles as $key => $role)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->guard_name ?? 'web' }}</td>
                                                <td>
                                                    {{ $role->created_at ? $role->created_at->format('d M Y') : '-' }}
                                                </td>
                                                <td>
                                                    {{-- Manage Permissions --}}
                                                    <a href="{{ route('roles.permissions', $role->id) }}"
                                                       class="btn btn-info btn-sm"
                                                       title="Manage Permissions">
                                                        <i class="zmdi zmdi-key"></i>
                                                    </a>

                                                    {{-- Edit --}}
                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                       class="btn btn-warning btn-sm"
                                                       title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>

                                                    {{-- Delete / Inactivate --}}
                                                    <form action="{{ route('roles.destroy', $role->id) }}"
                                                          method="POST"
                                                          style="display:inline-block"
                                                          onsubmit="return confirm('Are you sure you want to inactivate this role?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger btn-sm" title="Inactivate">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    No roles found.
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
