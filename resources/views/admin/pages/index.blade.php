{{-- @can('pages-list') --}}

@extends('layouts.app')

@section('title', 'Website Pages')

@section('content')

    <section class="content">

        <div class="body_scroll">

            <div class="block-header">

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <h2>Website Pages</h2>

                        <ul class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Pages
                            </li>

                        </ul>

                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">

                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">

                            <i class="zmdi zmdi-plus"></i>
                            Add Page

                        </a>

                    </div>

                </div>

            </div>


            <!-- =========================
                 MAIN CONTAINER
            ========================== -->

            <div class="container-fluid">

                <!-- Success Message -->

                @if(session('success'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">

                        <i class="zmdi zmdi-check-circle mr-2"></i>

                        {{ session('success') }}

                        <button type="button" class="close" data-dismiss="alert">

                            <span>&times;</span>

                        </button>

                    </div>

                @endif


                <!-- Error Message -->

                @if(session('error'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        <i class="zmdi zmdi-alert-circle mr-2"></i>

                        {{ session('error') }}

                        <button type="button" class="close" data-dismiss="alert">

                            <span>&times;</span>

                        </button>

                    </div>

                @endif


                <!-- =========================
                     PAGES TABLE
                ========================== -->

                <div class="row clearfix">

                    <div class="col-lg-12">

                        <div class="card">

                            <!-- Card Header -->

                            <div class="header">

                                <div class="row align-items-center">

                                    <div class="col-md-6">

                                        <h2>
                                            <strong>Website</strong> Pages
                                        </h2>

                                        <small class="text-muted">
                                            Manage your website pages and sections
                                        </small>

                                    </div>

                                    <div class="col-md-6 text-right">

                                        <span class="badge badge-info">

                                            {{ $pages->total() }}
                                            Pages

                                        </span>

                                    </div>

                                </div>

                            </div>


                            <!-- Card Body -->

                            <div class="body">

                                <div class="table-responsive">

                                    <table class="table table-hover table-bordered">

                                        <thead>

                                            <tr>

                                                <th width="70">
                                                    #
                                                </th>

                                                <th>
                                                    Page
                                                </th>

                                                <th>
                                                    Slug
                                                </th>

                                                <th width="120">
                                                    Status
                                                </th>

                                                <th width="280" class="text-center">

                                                    Action

                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            @forelse($pages as $page)

                                                <tr>

                                                    <!-- ID -->

                                                    <td>

                                                        {{ $pages->firstItem() + $loop->index }}

                                                    </td>


                                                    <!-- PAGE -->

                                                    <td>

                                                        <div class="d-flex align-items-center">

                                                            <div class="page-icon mr-3" style="
                                                                        width:40px;
                                                                        height:40px;
                                                                        border-radius:8px;
                                                                        background:#f1f4f8;
                                                                        display:flex;
                                                                        align-items:center;
                                                                        justify-content:center;
                                                                    ">

                                                                <i class="zmdi zmdi-file-text" style="font-size:20px;">
                                                                </i>

                                                            </div>


                                                            <div>

                                                                <strong>
                                                                    {{ $page->title }}
                                                                </strong>

                                                                <br>

                                                                <small class="text-muted">

                                                                    Created:
                                                                    {{ $page->created_at?->format('d M Y') }}

                                                                </small>

                                                            </div>

                                                        </div>

                                                    </td>


                                                    <!-- SLUG -->

                                                    <td>

                                                        <span class="text-muted">
                                                            {{ url($page->slug) }}
                                                        </span>

                                                    </td>


                                                    <!-- STATUS -->

                                                    <td>

                                                        @if($page->status)

                                                            <span class="badge badge-success">

                                                                <i class="zmdi zmdi-check"></i>

                                                                Active

                                                            </span>

                                                        @else

                                                            <span class="badge badge-danger">

                                                                <i class="zmdi zmdi-close"></i>

                                                                Inactive

                                                            </span>

                                                        @endif

                                                    </td>


                                                    <!-- ACTION -->

                                                    <td class="text-center">


                                                        <!-- Sections -->

                                                        <a href="{{ route('admin.pages.sections.index', $page) }}"
                                                            class="btn btn-info btn-sm" title="Manage Sections">

                                                            <i class="zmdi zmdi-view-list"></i>

                                                            Sections

                                                        </a>


                                                        <!-- Edit -->

                                                        <a href="{{ route('admin.pages.edit', $page) }}"
                                                            class="btn btn-warning btn-sm" title="Edit Page">

                                                            <i class="zmdi zmdi-edit"></i>

                                                            Edit

                                                        </a>


                                                        <!-- Delete -->

                                                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST"
                                                            class="d-inline">

                                                            @csrf

                                                            @method('DELETE')


                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Delete Page"
                                                                onclick="return confirm('Are you sure you want to delete this page?')">

                                                                <i class="zmdi zmdi-delete"></i>

                                                            </button>

                                                        </form>


                                                    </td>

                                                </tr>


                                            @empty

                                                <tr>

                                                    <td colspan="5" class="text-center">

                                                        <div class="py-5">

                                                            <i class="zmdi zmdi-file-text" style="
                                                                        font-size:50px;
                                                                        color:#ccc;
                                                                    "></i>


                                                            <h5 class="mt-3">

                                                                No Pages Found

                                                            </h5>


                                                            <p class="text-muted">

                                                                You haven't created
                                                                any website pages yet.

                                                            </p>


                                                            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">

                                                                <i class="zmdi zmdi-plus"></i>

                                                                Create First Page

                                                            </a>

                                                        </div>

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>


                                <!-- Pagination -->

                                @if($pages->hasPages())

                                    <div class="mt-3">

                                        {{ $pages->links() }}

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


@endsection

{{-- @else

@php
abort(403);
@endphp

@endcan --}}
