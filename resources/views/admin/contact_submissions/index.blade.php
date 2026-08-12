@extends('layouts.app')

@section('title', 'Contact Submissions')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <h2>Contact Submissions</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Contact Submissions
                        </li>
                    </ul>

                </div>

            </div>
        </div>

        <div class="container-fluid">

            <div class="card">

                <div class="header">
                    <h2>
                        <strong>Contact</strong> Submissions
                    </h2>
                </div>

                <div class="body">

                    @if($submissions->count())

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped" id="datatable">

                                <thead>
                                    <tr>
                                        <th>SrNo.</th>
                                        <th>Page</th>
                                        <th>Form</th>
                                        <th>Submitted Data</th>
                                        <th>Submitted At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($submissions as $submission)

                                        <tr>

                                            <td>
                                                {{ $submissions->firstItem() + $loop->index }}
                                            </td>

                                            <td>
                                                {{ $submission->page->title ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $submission->section->title ?? 'Contact Form' }}
                                            </td>

                                            <td>

                                                @foreach($submission->data ?? [] as $key => $value)

                                                    <div class="mb-1">

                                                        <strong>
                                                            {{ ucwords(str_replace('_', ' ', $key)) }}:
                                                        </strong>

                                                        @if(is_array($value))

                                                            {{ implode(', ', $value) }}

                                                        @else

                                                            {{ $value ?: '-' }}

                                                        @endif

                                                    </div>

                                                @endforeach

                                            </td>

                                            <td>
                                                {{ $submission->created_at->format('d M Y, h:i A') }}
                                            </td>

                                            <td>

                                                <a
                                                    href="{{ route('admin.contact-submissions.show', $submission->id) }}"
                                                    class="btn btn-primary btn-sm"
                                                >
                                                    <i class="zmdi zmdi-eye"></i>
                                                    View
                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="mt-3">
                            {{ $submissions->links() }}
                        </div>

                    @else

                        <div class="text-center py-5">

                            <i
                                class="zmdi zmdi-email"
                                style="font-size:50px;"
                            ></i>

                            <h4 class="mt-3">
                                No Contact Submissions Found
                            </h4>

                            <p class="text-muted">
                                Contact form submissions will appear here once visitors submit the form.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>
</section>

@endsection