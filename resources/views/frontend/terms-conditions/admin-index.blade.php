@extends('layouts.app')
@section('title', 'Terms & Conditions Management')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Terms & Conditions Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Terms & Conditions
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        @if($termsConditions->count() == 0)
                            <a href="{{ route('admin.terms-conditions.create') }}" class="btn btn-primary">
                                <i class="zmdi zmdi-plus"></i>
                                Add Terms & Conditions
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>Terms & Conditions</strong>
                                    List
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="60">SrNo.</th>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th width="150">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($termsConditions as $key => $termsCondition)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if($termsCondition->terms_conditions_category)
                                                            <strong>{{ $termsCondition->terms_conditions_category }}</strong>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>{{ $termsCondition->terms_conditions_title }}</strong>
                                                    </td>
                                                    <td>{{ $termsCondition->terms_conditions_subtitle ?? '-' }}</td>
                                                    <td>
                                                        @if($termsCondition->terms_conditions_iamage)
                                                            <img src="{{ asset('storage/' . $termsCondition->terms_conditions_iamage) }}"
                                                                alt="{{ $termsCondition->terms_conditions_title }}" width="70"
                                                                height="50" style="object-fit: cover; border-radius: 5px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(($termsCondition->status ?? 1) == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $termsCondition->created_at ? $termsCondition->created_at->format('d M Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.terms-conditions.edit', $termsCondition->id) }}"
                                                            class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.terms-conditions.destroy', $termsCondition->id) }}"
                                                            method="POST" class="d-inline delete-form"
                                                            data-terms-title="{{ $termsCondition->terms_conditions_title }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        No Terms & Conditions found.
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
