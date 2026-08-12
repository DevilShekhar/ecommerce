@extends('layouts.app')

@section('title', 'Offers')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Offers</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Offers</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.offer.create') }}" class="btn btn-primary">
                        <i class="zmdi zmdi-plus"></i> Add Offer
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="zmdi zmdi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>All</strong> Offers</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="60">#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th width="120">Status</th>
                                            <th width="160" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($offers as $key => $offer)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><strong>{{ $offer->title }}</strong></td>
                                                <td>{{ $offer->category->name ?? '-' }}</td>
                                                <td>
                                                    @if($offer->status)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.offer.edit', $offer) }}" class="btn btn-warning btn-sm">
                                                        <i class="zmdi zmdi-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.offer.destroy', $offer) }}" method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <i class="zmdi zmdi-folder" style="font-size:40px;color:#ccc;"></i>
                                                    <h5 class="mt-2">No Offers Found</h5>
                                                    <a href="{{ route('admin.offer.create') }}" class="btn btn-primary mt-2">
                                                        <i class="zmdi zmdi-plus"></i> Create First Offer
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