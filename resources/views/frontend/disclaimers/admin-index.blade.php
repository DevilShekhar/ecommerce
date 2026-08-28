@extends('layouts.app')

@section('title', 'Disclaimers')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Disclaimers</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Disclaimers
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        @if($disclaimers->count() == 0)                        
                            <a href="{{ route('disclaimers.create') }}" class="btn btn-success">
                                <i class="zmdi zmdi-plus"></i>
                                Add Disclaimer
                            </a>
                        @endif
                </div>

            </div>
        </div>

        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="zmdi zmdi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="row clearfix">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">
                            <h2>
                                <strong>Disclaimer</strong> List
                            </h2>
                        </div>

                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover">

                                    <thead>
                                        <tr>
                                            <th width="60">#</th>
                                            <th width="100">Image</th>
                                            <th>Sub Title</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th width="100">Status</th>
                                            <th width="180">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($disclaimers as $key => $disclaimer)

                                            <tr>

                                                <td>
                                                    {{ $key + 1 }}
                                                </td>

                                                <td>
                                                    @if($disclaimer->section_image)
                                                        <img
                                                            src="{{ asset($disclaimer->section_image) }}"
                                                            alt="{{ $disclaimer->title }}"
                                                            style="width:70px;height:55px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">
                                                    @else
                                                        <div style="width:70px;height:55px;background:#f5f5f5;border-radius:6px;display:flex;align-items:center;justify-content:center;">
                                                            <i class="zmdi zmdi-image" style="font-size:22px;color:#aaa;"></i>
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ $disclaimer->subtitle ?? '-' }}
                                                </td>

                                                <td>
                                                    <strong>
                                                        {{ $disclaimer->title }}
                                                    </strong>
                                                </td>

                                                <td>
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($disclaimer->description), 80) }}
                                                </td>

                                                <td>

                                                    @if($disclaimer->status)

                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>

                                                    @else

                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>

                                                    @endif

                                                </td>

                                                <td>

                                                    <div class="btn-group">

                                                            <a href="{{ route('admin.disclaimers.edit', $disclaimer->id) }}"
                                                                class="btn btn-sm btn-primary"
                                                                title="Edit">

                                                                <i class="zmdi zmdi-edit"></i>

                                                            </a>


                                                            <form method="POST"
                                                                action="{{ route('admin.disclaimers.destroy', $disclaimer->id) }}"
                                                                style="display:inline-block;"
                                                                onsubmit="return confirm('Are you sure you want to delete this disclaimer?');">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger"
                                                                    title="Delete">

                                                                    <i class="zmdi zmdi-delete"></i>

                                                                </button>

                                                            </form>


                                                    </div>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="7" class="text-center">

                                                    <div style="padding:40px 20px;">

                                                        <i class="zmdi zmdi-info-outline"
                                                            style="font-size:45px;color:#ccc;"></i>

                                                        <h5 class="mt-3">
                                                            No Disclaimer Found
                                                        </h5>

                                                       

                                                            <a href="{{ route('disclaimers.create') }}"
                                                                class="btn btn-success mt-2">

                                                                <i class="zmdi zmdi-plus"></i>
                                                                Create Disclaimer

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