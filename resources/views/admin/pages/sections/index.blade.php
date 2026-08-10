{{-- @can('pages-sections-list') --}}

@extends('layouts.app')

@section('title', $page->title . ' Sections')

@section('content')

<section class="content">

    <div class="body_scroll">

        <!-- =========================
             PAGE HEADER
        ========================== -->

        <div class="block-header">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <h2>
                        {{ $page->title }} - Sections
                    </h2>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item">

                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i>
                                Dashboard
                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="{{ route('admin.pages.index') }}">
                                Pages
                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            {{ $page->title }} Sections

                        </li>

                    </ul>

                </div>


                <div class="col-lg-6 col-md-6 col-sm-12 text-right">

                    <a href="{{ route('admin.pages.index') }}"
                       class="btn btn-danger">

                        <i class="zmdi zmdi-arrow-left"></i>
                        Back

                    </a>

                    <a href="{{ route('admin.pages.sections.create', $page) }}"
                       class="btn btn-primary">

                        <i class="zmdi zmdi-plus"></i>
                        Add Section

                    </a>

                </div>

            </div>

        </div>


        <!-- =========================
             CONTAINER
        ========================== -->

        <div class="container-fluid">


            <!-- Success Message -->

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">

                    <i class="zmdi zmdi-check-circle"></i>

                    {{ session('success') }}

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            @endif


            <!-- Error Message -->

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    <i class="zmdi zmdi-alert-circle"></i>

                    {{ session('error') }}

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            @endif


            <div class="row clearfix">

                <div class="col-lg-12">

                    <div class="card">


                        <!-- =========================
                             CARD HEADER
                        ========================== -->

                        <div class="header">

                            <div class="row align-items-center">

                                <div class="col-md-6">

                                    <h2>
                                        <strong>{{ $page->title }}</strong>
                                        Sections
                                    </h2>

                                    <small class="text-muted">

                                        Manage sections of this page

                                    </small>

                                </div>


                                <div class="col-md-6 text-right">

                                    <span class="badge badge-info">

                                        {{ $sections->count() }}
                                        Sections

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- =========================
                             CARD BODY
                        ========================== -->

                        <div class="body">


                            @forelse($sections as $section)


                                <!-- =========================
                                     SECTION ITEM
                                ========================== -->

                                <div class="border rounded p-3 mb-3">

                                    <div class="row align-items-center">


                                        <!-- SORT ORDER -->

                                        <div class="col-lg-1 col-md-1 col-sm-12">

                                            <div class="text-center">

                                                <span
                                                    class="badge badge-secondary"
                                                    style="font-size:13px;"
                                                >

                                                    #{{ $section->sort_order }}

                                                </span>

                                            </div>

                                        </div>


                                        <!-- SECTION TYPE -->

                                        <div class="col-lg-2 col-md-2 col-sm-12">

                                            <strong>

                                                {{ ucfirst($section->section_type) }}

                                            </strong>

                                        </div>


                                        <!-- TITLE -->

                                        <div class="col-lg-3 col-md-3 col-sm-12">

                                            @if($section->title)

                                                <strong>

                                                    {{ $section->title }}

                                                </strong>

                                            @else

                                                <span class="text-muted">

                                                    No title

                                                </span>

                                            @endif

                                            @if($section->sub_title)

                                                <br>

                                                <small class="text-muted">

                                                    {{ $section->sub_title }}

                                                </small>

                                            @endif

                                        </div>


                                        <!-- IMAGE -->

                                        <div class="col-lg-2 col-md-2 col-sm-12">

                                            @if($section->image)

                                                <img
                                                    src="{{ asset('storage/' . $section->image) }}"
                                                    alt="{{ $section->title }}"
                                                    style="
                                                        width:60px;
                                                        height:45px;
                                                        object-fit:cover;
                                                        border-radius:5px;
                                                    "
                                                >

                                            @else

                                                <span class="text-muted">

                                                    No Image

                                                </span>

                                            @endif

                                        </div>


                                        <!-- STATUS -->

                                        <div class="col-lg-1 col-md-1 col-sm-12">

                                            @if($section->status)

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

                                        </div>


                                        <!-- ACTION -->

                                        <div class="col-lg-3 col-md-3 col-sm-12 text-right">


                                            <!-- Edit -->

                                            <a
                                                href="{{ route('admin.pages.sections.edit', [$page, $section]) }}"
                                                class="btn btn-warning btn-sm"
                                            >

                                                <i class="zmdi zmdi-edit"></i>

                                                Edit

                                            </a>


                                            <!-- Delete -->

                                            <form
                                                action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}"
                                                method="POST"
                                                class="d-inline"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this section?')"
                                                >

                                                    <i class="zmdi zmdi-delete"></i>

                                                    Delete

                                                </button>

                                            </form>

                                        </div>


                                    </div>

                                </div>


                            @empty


                                <!-- =========================
                                     NO SECTIONS
                                ========================== -->

                                <div class="text-center py-5">

                                    <i
                                        class="zmdi zmdi-view-list"
                                        style="
                                            font-size:55px;
                                            color:#ccc;
                                        "
                                    ></i>


                                    <h5 class="mt-3">

                                        No Sections Added Yet

                                    </h5>


                                    <p class="text-muted">

                                        Start building this page by
                                        adding your first section.

                                    </p>


                                    <a
                                        href="{{ route('admin.pages.sections.create', $page) }}"
                                        class="btn btn-primary"
                                    >

                                        <i class="zmdi zmdi-plus"></i>

                                        Add First Section

                                    </a>

                                </div>


                            @endforelse


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
