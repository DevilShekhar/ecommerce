@extends('layouts.app')
@section('title', 'Contact Us Management')
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Contact Us Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Contact Us
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        @if($contacts->count() == 0)
                            <a href="{{ route('admin.contact-us.create') }}" class="btn btn-primary">
                                <i class="zmdi zmdi-plus"></i>
                                Add Contact Us
                            </a>
                        @endif
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
                                <h2>
                                    <strong>Contact Us</strong> List
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="50">SrNo.</th>
                                                <th width="100">Image</th>
                                                <th>Title</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>WhatsApp</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th width="150">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($contacts as $key => $contact)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        @if($contact->contact_image)
                                                            <img src="{{ asset('storage/' . $contact->contact_image) }}"
                                                                alt="Contact"
                                                                style="width:70px;height:50px;object-fit:cover;border-radius:5px;">
                                                        @else
                                                            <span class="text-muted">No Image</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <strong>{{ $contact->contact_title }}</strong>
                                                    </td>
                                                    <td>{{ $contact->contact_phone ?? '-' }}</td>
                                                    <td>{{ $contact->contact_email ?? '-' }}</td>
                                                    <td>{{ $contact->contact_whatsapp_no ?? '-' }}</td>
                                                    <td>
                                                        @if($contact->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $contact->created_at ? $contact->created_at->format('d M Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.contact-us.edit', $contact->id) }}"
                                                            class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.contact-us.destroy', $contact->id) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                                title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">
                                                        No Contact Us records found.
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