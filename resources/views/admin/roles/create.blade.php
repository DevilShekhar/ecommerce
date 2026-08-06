@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="block-header">
            <h2>Create Role</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Create</strong> Role</h2>
                    </div>

                    <div class="body">
                        <form id="role-create-form" method="POST" action="{{ route('roles.store') }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{ auth()->check() ? 'Logged In' : 'Not Logged In' }}
    </div>

@endsection

@section('page_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('role-create-form');
            if (form) {
                $(form).off('submit');
            }
        });
    </script>
@endsection
