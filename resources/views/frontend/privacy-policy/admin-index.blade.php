@extends('layouts.app')
@section('title', 'Privacy Policy')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Privacy Policy</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item active">Privacy Policy</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        @if($privacyPolicies->count() == 0)
                            <a href="{{ route('admin.privacy-policies.create') }}" class="btn btn-success"><i
                                    class="zmdi zmdi-plus"></i> Add Privacy Policy</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Privacy Policy</strong> Sections</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Subtitle</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($privacyPolicies as $privacyPolicy)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if($privacyPolicy->privacy_policy_image)
                                                            <img src="{{ asset('storage/' . $privacyPolicy->privacy_policy_image) }}"
                                                                alt="Privacy Policy"
                                                                style="width:70px;height:50px;object-fit:cover;border-radius:5px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $privacyPolicy->privacy_policy_title }}</td>
                                                    <td>{{ $privacyPolicy->privacy_policy_subtitle ?: '-' }}</td>
                                                    <td>
                                                        @if($privacyPolicy->status)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $privacyPolicy->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.privacy-policies.edit', $privacyPolicy) }}"
                                                            class="btn btn-sm btn-primary"><i class="zmdi zmdi-edit"></i></a>
                                                        
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No Privacy Policy content found.</td>
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
