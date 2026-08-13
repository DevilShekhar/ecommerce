@extends('layouts.app')

@section('title', 'Offer Categories')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Offer Categories</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Offer Categories</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif

            <div class="row clearfix">
                {{-- ================= CREATE / EDIT FORM ================= --}}
                <div class="col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2 id="formTitle"><strong>Add</strong> Category</h2>
                        </div>
                        <div class="body">
                            <form id="categoryForm" action="{{ route('admin.offer-category.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" id="formMethod" value="POST">

                                <div class="form-group">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="zmdi zmdi-plus"></i> Create
                                    </button>
                                    <button type="button" class="btn btn-secondary d-none" id="cancelBtn">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ================= LIST ================= --}}
                <div class="col-lg-8">
                    <div class="card">
                        <div class="header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2><strong>All</strong> Categories</h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="badge badge-info">{{ $categories->count() }} Categories</span>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="datatable">
                                    <thead>
                                        <tr>
                                            <th width="60">SrNo.</th>
                                            <th>Name</th>
                                            <th width="120">Status</th>
                                            <th width="160" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $key => $category)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><strong>{{ $category->name }}</strong></td>
                                                <td>
                                                    @if($category->status)
                                                        <span class="badge badge-success">
                                                            <i class="zmdi zmdi-check"></i> Active
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            <i class="zmdi zmdi-close"></i> Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm editBtn"
                                                        data-id="{{ $category->id }}"
                                                        data-name="{{ $category->name }}"
                                                        data-status="{{ $category->status }}">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>

                                                    <form action="{{ route('admin.offer-category.destroy', $category) }}"
                                                          method="POST"
                                                          class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4">
                                                    <i class="zmdi zmdi-folder" style="font-size:40px;color:#ccc;"></i>
                                                    <h5 class="mt-2">No Categories Found</h5>
                                                    <p class="text-muted mb-0">Add your first category using the form.</p>
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

@push('scripts')
<script>
    $(document).ready(function () {

        // Edit button
        $(document).on('click', '.editBtn', function () {
            let id     = $(this).data('id');
            let name   = $(this).data('name');
            let status = $(this).data('status');

            $('#name').val(name);
            $('#status').val(status);

            $('#formTitle').html('<strong>Edit</strong> Category');
            $('#formMethod').val('PUT');
            $('#categoryForm').attr('action', "{{ url('admin/offer-category') }}/" + id);   // ← FIXED
            $('#submitBtn').html('<i class="zmdi zmdi-check"></i> Update');
            $('#cancelBtn').removeClass('d-none');
        });

        // Cancel button
        $('#cancelBtn').on('click', function () {
            resetForm();
        });

        function resetForm() {
            $('#formTitle').html('<strong>Add</strong> Category');
            $('#categoryForm')[0].reset();
            $('#formMethod').val('POST');
            $('#categoryForm').attr('action', "{{ route('admin.offer-category.store') }}");
            $('#submitBtn').html('<i class="zmdi zmdi-plus"></i> Create');
            $('#cancelBtn').addClass('d-none');
        }
    });
</script>
@endpush
