

@extends('layouts.app')

@section('title', 'Banner Management')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Banner Management</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Banners
                        </li>
                    </ul>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Add Banner
                        </a>
                </div>

            </div>
        </div>


        <div class="container-fluid">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            <div class="row clearfix">
                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">
                            <h2><strong>Banner</strong> List</h2>
                        </div>


                        <div class="body">

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

                                    <thead>
                                        <tr>
                                            <th width="50">SrNo.</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Banner Type</th>
                                            <th>Link Type</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Banner Status</th>
                                            <th>Status</th>
                                            <th>Sort Order</th>
                                            <th>Created At</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @forelse($banners as $key => $banner)

                                            <tr>

                                                {{-- Sr No --}}
                                                <td>{{ $key + 1 }}</td>


                                                {{-- Image --}}
                                                <td>
                                                    @if($banner->image)
                                                        <img
                                                            src="{{ asset('storage/' . $banner->image) }}"
                                                            alt="{{ $banner->title }}"
                                                            style="width: 100px; height: 60px; object-fit: cover;"
                                                        >
                                                    @else
                                                        <span class="text-muted">
                                                            No Image
                                                        </span>
                                                    @endif
                                                </td>


                                                {{-- Title --}}
                                                <td>
                                                    <strong>
                                                        {{ $banner->title ?? '-' }}
                                                    </strong>
                                                </td>


                                                {{-- Banner Type --}}
                                                <td>

                                                    @php
                                                        $bannerTypes = [
                                                            'homepage_slider' => 'Homepage Slider',
                                                            'promotional' => 'Promotional Banner',
                                                            'category' => 'Category Banner',
                                                            'festival' => 'Festival Banner',
                                                            'popup' => 'Popup Banner',
                                                            'mobile' => 'Mobile Banner',
                                                        ];
                                                    @endphp

                                                    {{ $bannerTypes[$banner->banner_type] ?? ucfirst($banner->banner_type) }}

                                                </td>


                                                {{-- Link Type --}}
                                                <td>

                                                    @php
                                                        $linkTypes = [
                                                            'none' => 'None',
                                                            'custom_url' => 'Custom URL',
                                                            'product' => 'Product',
                                                            'category' => 'Category',
                                                        ];
                                                    @endphp

                                                    {{ $linkTypes[$banner->link_type] ?? '-' }}

                                                </td>


                                                {{-- Start Date --}}
                                                <td>
                                                    {{ $banner->start_date ? $banner->start_date->format('d M Y') : '-' }}
                                                </td>


                                                {{-- End Date --}}
                                                <td>
                                                    {{ $banner->end_date ? $banner->end_date->format('d M Y') : '-' }}
                                                </td>

                                                <td>
                                                    @if(now()->lt($banner->start_date))
                                                        <span class="badge badge-warning">Upcoming</span>
                                                    @elseif(now()->gt($banner->end_date))
                                                        <span class="badge badge-danger">Expired</span>
                                                    @else
                                                        <span class="badge badge-success">Available</span>
                                                    @endif
                                                </td>

                                                {{-- Status --}}
                                                <td>
                                                    @if($banner->status == 1)
                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>


                                                {{-- Sort Order --}}
                                                <td>
                                                    {{ $banner->sort_order }}
                                                </td>


                                                {{-- Created At --}}
                                                <td>
                                                    {{ $banner->created_at ? $banner->created_at->format('d M Y') : '-' }}
                                                </td>


                                                {{-- Action --}}
                                                <td>

                                                    {{-- Edit --}}
                                                        <a
                                                            href="{{ route('admin.banners.edit', $banner->id) }}"
                                                            class="btn btn-warning btn-sm"
                                                            title="Edit"
                                                        >
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>

                                                    {{-- Delete --}}
                                                        <form
                                                            action="{{ route('admin.banners.destroy', $banner->id) }}"
                                                            method="POST"
                                                            class="d-inline delete-form"
                                                            data-banner-name="{{ $banner->title ?? 'Banner' }}"
                                                        >
                                                            @csrf
                                                            @method('DELETE')

                                                            <button
                                                                type="button"
                                                                class="btn btn-sm btn-danger delete-btn"
                                                                title="Delete"
                                                            >
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    No banners found.
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
