@extends('layouts.app')
@section('title', 'Home Sections')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Home Sections</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Home Sections</li>
                        </ul>
                    </div>
                    @if($homeSections->count() < 0)
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-success">
                            <i class="zmdi zmdi-plus"></i> Add Home Section
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Home</strong> Sections</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="60">#</th>
                                                <th width="120">Image</th>
                                                <th>Sub Title</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th width="100">Status</th>
                                                <th width="150">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($homeSections as $key => $section)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if($section->image)
                                                            <img src="{{ asset('storage/' . $section->image) }}"
                                                                alt="{{ $section->title }}"
                                                                style="width:80px;height:80px;object-fit:cover;border-radius:6px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $section->subtitle ?: '-' }}</td>
                                                    <td><strong>{{ $section->title }}</strong></td>
                                                    <td>
                                                        @php $description = strip_tags($section->description); @endphp
                                                        {{ \Illuminate\Support\Str::limit($description, 100) }}
                                                    </td>
                                                    <td>
                                                        @if($section->status)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.sections.edit', $section->id) }}"
                                                            class="btn btn-sm btn-primary"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        </a>
                                                        <form action="{{ route('admin.sections.destroy', $section->id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Are you sure you want to delete this Home Section?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            @if($homeSections->count() < 0)
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <div class="py-4">
                                                            <i class="zmdi zmdi-info-outline" style="font-size:40px;"></i>
                                                            <h5 class="mt-2">No Home Sections Found</h5>
                                                            <p class="text-muted">Create your first Home Section.</p>
                                                            <a href="{{ route('admin.sections.index') }}"
                                                                class="btn btn-success">
                                                                <i class="zmdi zmdi-plus"></i> Add Home Section
                                                            </a>
                                                        </div>
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