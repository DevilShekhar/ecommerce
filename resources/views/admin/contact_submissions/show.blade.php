@extends('layouts.app')

@section('title', 'Contact Submission')

@section('content')

    <section class="content">
        <div class="body_scroll">

            <div class="block-header">

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <h2>Contact Submission</h2>

                        <ul class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.contact-submissions.index') }}">
                                    Contact Submissions
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                View
                            </li>

                        </ul>

                    </div>

                    <div class="col-lg-6 text-right">

                        <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a>

                    </div>

                </div>

            </div>


            <div class="container-fluid">

                <div class="card">

                    <div class="header">
                        <h2>
                            <strong>Submission</strong> Details
                        </h2>
                    </div>

                    <div class="body">

                        <div class="row mb-4">

                            <div class="col-md-4">
                                <strong>Form</strong>

                                <p>
                                    {{ $submission->section->title ?? 'Contact Form' }}
                                </p>
                            </div>

                            <div class="col-md-4">
                                <strong>Submitted At</strong>

                                <p>
                                    {{ $submission->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>

                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width:30%;">First Name</th>
                                        <td>{{ $submission->first_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $submission->last_name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $submission->email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Interest</th>
                                        <td>{{ $submission->interest ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Message</th>
                                        <td>{!! nl2br(e($submission->message ?? '-')) !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <hr>

                        <div class="row">

                            <div class="col-md-6">

                                <strong>IP Address</strong>

                                <p>
                                    {{ $submission->ip_address ?? '-' }}
                                </p>

                            </div>

                            <div class="col-md-6">

                                <strong>User Agent</strong>

                                <p style="word-break:break-word;">
                                    {{ $submission->user_agent ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
