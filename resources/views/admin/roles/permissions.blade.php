@extends('layouts.app')

@section('title', 'Manage Permissions')

@section('content')
<section class="content">
    <div class="body_scroll">

        <!-- Block Header -->
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Manage Permissions</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">Permissions</li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                        <i class="zmdi zmdi-arrow-left"></i> Back
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
                            <h2>
                                <strong>Manage</strong> Permissions
                                <small>Role : <strong>{{ $role->name }}</strong></small>
                            </h2>
                        </div>

                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Permission Name</th>
                                            <th width="100">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($permissions as $key => $permission)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <div class="permission-item">
                                                        <label class="permission-label" style="cursor:pointer; margin:0; display:flex; align-items:center;">
                                                            <input type="checkbox"
                                                                   class="permission-checkbox"
                                                                   name="permissions[]"
                                                                   value="{{ $permission->name }}"
                                                                   {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                                                   style="margin-right: 10px;">
                                                            <span class="permission-name">
                                                                {{ ucwords(str_replace(['.', '_', '-'], ' ', $permission->name)) }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(in_array($permission->name, $rolePermissions))
                                                        <span class="badge badge-success">Assigned</span>
                                                    @else
                                                        <span class="badge badge-secondary">Not Assigned</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    No permissions found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-lg-12 text-right">
                                    <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-success">
                                            <i class="zmdi zmdi-check"></i> Update Permissions
                                        </button>

                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                            <i class="zmdi zmdi-close"></i> Cancel
                                        </a>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select All / Deselect All functionality (optional)
        // Add this if you want a select all checkbox in the header

        // Toggle individual permission status display
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const statusBadge = row.querySelector('.badge');

                if (this.checked) {
                    statusBadge.className = 'badge badge-success';
                    statusBadge.textContent = 'Assigned';
                } else {
                    statusBadge.className = 'badge badge-secondary';
                    statusBadge.textContent = 'Not Assigned';
                }
            });
        });
    });
</script>

<style>
    /* Additional styles to match the warehouse design */
    .permission-item {
        padding: 2px 0;
    }

    .permission-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        margin: 0;
        width: 100%;
    }

    .permission-checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
        margin-right: 12px !important;
        flex-shrink: 0;
    }

    .permission-name {
        font-size: 14px;
        font-weight: 400;
        color: #333;
        user-select: none;
    }

    .permission-checkbox:checked + .permission-name {
        color: #28a745;
        font-weight: 500;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        font-size: 12px;
        padding: 5px 12px;
        border-radius: 4px;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #fff;
    }

    .mt-4 {
        margin-top: 1.5rem !important;
    }
</style>
@endpush
