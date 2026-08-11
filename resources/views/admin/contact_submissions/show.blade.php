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

                    <a
                        href="{{ route('admin.contact-submissions.index') }}"
                        class="btn btn-danger"
                    >
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
                            <strong>Page</strong>

                            <p>
                                {{ $submission->page->title ?? '-' }}
                            </p>
                        </div>

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

                                @foreach($submission->data ?? [] as $key => $value)

                                    <tr>

                                        <th style="width:30%;">
                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                        </th>

                                        <td>

                                            @if(is_array($value))

                                                {{ implode(', ', $value) }}

                                            @elseif(
                                                is_string($value) &&
                                                str_starts_with($value, 'contact-submissions/')
                                            )

                                                <a
                                                    href="{{ asset('storage/' . $value) }}"
                                                    target="_blank"
                                                    class="btn btn-sm btn-primary"
                                                >
                                                    View File
                                                </a>

                                            @else

                                                {!! nl2br(e($value ?: '-')) !!}

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

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