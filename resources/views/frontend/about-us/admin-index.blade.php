@extends('layouts.app')
@section('title', 'About Us')
@section('content')
    <section class="content">
        <div class="body_scroll">
            {{-- PAGE HEADER --}}
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>About Us</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                About Us
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        @if($aboutUs->count() == 0)
                            <a href="{{ route('admin.about-us.create') }}" class="btn btn-success">
                                <i class="zmdi zmdi-plus"></i>
                                Add About Us
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
            {{-- TABLE --}}
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>About</strong> Us Content
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="60">
                                                    #
                                                </th>
                                                <th>
                                                    About Image
                                                </th>
                                                <th>
                                                    About
                                                </th>
                                                <th>
                                                    Mission
                                                </th>
                                                <th>
                                                    Vision
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th width="180">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($aboutUs as $item)
                                                <tr>
                                                    {{-- NUMBER --}}
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    {{-- IMAGE --}}
                                                    <td>
                                                        @if($item->about_image)
                                                            <img src="{{ asset('storage/' . $item->about_image) }}"
                                                                alt="{{ $item->about_title }}" width="80" height="60"
                                                                style="object-fit:cover;border-radius:6px;">
                                                        @else
                                                            <span class="text-muted">
                                                                No Image
                                                            </span>
                                                        @endif
                                                    </td>
                                                    {{-- ABOUT --}}
                                                    <td>
                                                        <strong>
                                                            {{ $item->about_title }}
                                                        </strong>
                                                        @if($item->about_sub_title)
                                                            <br>
                                                            <small class="text-muted">
                                                                {{ $item->about_sub_title }}
                                                            </small>
                                                        @endif
                                                    </td>
                                                    {{-- MISSION --}}
                                                    <td>
                                                        <strong>
                                                            {{ $item->mission_title }}
                                                        </strong>
                                                        @if($item->mission_sub_title)
                                                            <br>
                                                            <small class="text-muted">
                                                                {{ $item->mission_sub_title }}
                                                            </small>
                                                        @endif
                                                    </td>
                                                    {{-- VISION --}}
                                                    <td>
                                                        <strong>
                                                            {{ $item->vision_title }}
                                                        </strong>
                                                        @if($item->vision_sub_title)
                                                            <br>
                                                            <small class="text-muted">
                                                                {{ $item->vision_sub_title }}
                                                            </small>
                                                        @endif
                                                    </td>
                                                    {{-- STATUS --}}
                                                    <td>
                                                        @if($item->status)
                                                            <span class="badge badge-success">
                                                                Active
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger">
                                                                Inactive
                                                            </span>
                                                        @endif
                                                    </td>
                                                    {{-- ACTION --}}
                                                    <td>
                                                        {{-- EDIT --}}
                                                        <a href="{{ route('admin.about-us.edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        {{-- VIEW CUSTOMER PAGE --}}
                                                        <a href="{{ route('about-us') }}" target="_blank"
                                                            class="btn btn-sm btn-info" title="View">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </a>
                                                        {{-- DELETE --}}
                                                        <form action="{{ route('admin.about-us.destroy', $item->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Are you sure you want to delete this About Us content?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">
                                                        <i class="zmdi zmdi-info-outline" style="font-size:40px;"></i>
                                                        <h5 class="mt-2">
                                                            No About Us Content Found
                                                        </h5>
                                                        <p class="text-muted">
                                                            Add your About Us content from the button below.
                                                        </p>
                                                        <a href="{{ route('admin.about-us.create') }}" class="btn btn-success">
                                                            <i class="zmdi zmdi-plus"></i>
                                                            Add About Us
                                                        </a>
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
