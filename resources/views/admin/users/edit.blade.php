@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <section class="content">
        <div class="body_scroll">

            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Edit User</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('users.index') }}">
                                    Users
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Edit User
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row clearfix">

                        <div class="col-lg-12">
                            <div class="card">

                                <div class="header">
                                    <h2><strong>Edit</strong> User</h2>
                                </div>

                                <div class="body">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>

                                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>

                                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Role</label>

                                                <select name="role_id" class="form-control">
                                                    <option value="">Select Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>

                                                <textarea name="address" rows="4"
                                                    class="form-control">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>

                                                <select name="status" class="form-control">
                                                    <option value="1" {{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0" {{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body text-right">

                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>

                                    <button class="btn btn-success">
                                        <i class="zmdi zmdi-save"></i>
                                        Update User
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
