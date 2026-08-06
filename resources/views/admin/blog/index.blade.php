@extends('layouts.app')

@section('title', 'Blog Management')

@section('content')
<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Blog Management</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                        <i class="zmdi zmdi-plus"></i> Add Blog
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
                            <h2><strong>Blog</strong> List</h2>
                        </div>

                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                    <thead>
                                    <tr>
                                        <th>SrNo.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th width="170">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @forelse($blogs as $key => $blog)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td width="90">
                                                @if($blog->image)
                                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                                        width="70"
                                                        height="50"
                                                        class="rounded"
                                                        style="object-fit: cover;"
                                                        alt="Blog Image">
                                                @else
                                                    <img src="{{ asset('assets/images/no-image.png') }}"
                                                        width="70"
                                                        height="50"
                                                        class="rounded"
                                                        alt="No Image">
                                                @endif
                                            </td>
                                            <td>{{ $blog->name }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->slug }}</td>
                                            <td>{{ optional($blog->creator)->name ?? '-' }}</td>
                                            <td>{{ $blog->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('blogs.show',$blog->id) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                                <a href="{{ route('blogs.edit',$blog->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <form action="{{ route('blogs.destroy',$blog->id) }}"
                                                method="POST"
                                                class="delete-form"
                                                style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>

                                            </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                No blogs found.
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
<script>

$(document).ready(function () {

    $('.delete-form').on('submit', function(e){

        e.preventDefault();

        let form = this;

        Swal.fire({

            title: 'Are you sure?',

            text: "You want to deactivate this blog.",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d33',

            cancelButtonColor: '#3085d6',

            confirmButtonText: 'Yes, Deactivate',

            cancelButtonText: 'Cancel'

        }).then((result) => {

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>
@endsection
