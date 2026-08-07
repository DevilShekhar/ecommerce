@can('blogs.show')
@extends('layouts.app')

@section('title','View Blog')

@section('content')

<section class="content">

    <div class="body_scroll">

        <div class="block-header">

            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <h2>View Blog</h2>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('blogs.index') }}">
                                Blogs
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            View Blog
                        </li>

                    </ul>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">

                    <a href="{{ route('blogs.index') }}"
                       class="btn btn-danger">

                        <i class="zmdi zmdi-arrow-left"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>

        <div class="container-fluid">

            <div class="row clearfix">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">

                            <h2>

                                <strong>Blog</strong> Information

                            </h2>

                        </div>

                        <div class="body">

                            <div class="row">

                                <div class="col-md-4">

                                    <label><strong>Featured Image</strong></label>

                                    <br>

                                    @if($blog->image)

                                        <img
                                            src="{{ asset('storage/'.$blog->image) }}"
                                            class="img-fluid rounded border"
                                            style="max-height:250px;">

                                    @else

                                        <img
                                            src="{{ asset('assets/images/no-image.png') }}"
                                            class="img-fluid rounded border"
                                            style="max-height:250px;">

                                    @endif

                                </div>

                                <div class="col-md-8">

                                    <table class="table table-bordered">

                                        <tr>

                                            <th width="200">
                                                Blog Name
                                            </th>

                                            <td>
                                                {{ $blog->name }}
                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Blog Title
                                            </th>

                                            <td>
                                                {{ $blog->title }}
                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Slug
                                            </th>

                                            <td>
                                                {{ $blog->slug }}
                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Created By
                                            </th>

                                            <td>

                                                {{ optional($blog->creator)->name ?? '-' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>
                                                Created Date
                                            </th>

                                            <td>

                                                {{ $blog->created_at->format('d M Y h:i A') }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-md-12">

                                    <label>

                                        <strong>

                                            Blog Description

                                        </strong>

                                    </label>

                                    <div class="border rounded p-3">

                                        {!! $blog->description !!}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                                <!-- SEO Information -->
                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">

                            <h2>

                                <strong>SEO</strong> Information

                            </h2>

                        </div>

                        <div class="body">

                            <table class="table table-bordered">

                                <tr>

                                    <th width="220">
                                        Meta Title
                                    </th>

                                    <td>
                                        {{ $blog->meta_title ?: '-' }}
                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        Meta Keywords
                                    </th>

                                    <td>
                                        {{ $blog->meta_keyword ?: '-' }}
                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        Meta Description
                                    </th>

                                    <td>

                                        {!! $blog->meta_description ?: '-' !!}

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- FAQ Section -->
                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">

                            <h2>

                                <strong>Blog FAQs</strong>

                            </h2>

                        </div>

                        <div class="body">

                            @if($blog->faqs->count())

                                @foreach($blog->faqs as $key => $faq)

                                    <div class="card mb-3">

                                        <div class="body">

                                            <h6>

                                                <strong>

                                                    Q{{ $key + 1 }}.
                                                    {{ $faq->question }}

                                                </strong>

                                            </h6>

                                            <hr>

                                            <p class="mb-0">

                                                {!! nl2br(e($faq->answer)) !!}

                                            </p>

                                        </div>

                                    </div>

                                @endforeach

                            @else

                                <div class="alert alert-warning mb-0">

                                    No FAQs available.

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

                <!-- Audit Information -->
                <div class="col-lg-12">

                    <div class="card">

                        <div class="header">

                            <h2>

                                <strong>Audit</strong> Information

                            </h2>

                        </div>

                        <div class="body">

                            <table class="table table-bordered">

                                <tr>

                                    <th width="220">
                                        Created By
                                    </th>

                                    <td>

                                        {{ optional($blog->creator)->name ?? '-' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        Created At
                                    </th>

                                    <td>

                                        {{ $blog->created_at ? $blog->created_at->format('d M Y h:i A') : '-' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        Last Updated
                                    </th>

                                    <td>

                                        {{ $blog->updated_at ? $blog->updated_at->format('d M Y h:i A') : '-' }}

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- Back Button -->
                <div class="col-lg-12">

                    <div class="card">

                        <div class="body text-right">

                            <a href="{{ route('blogs.index') }}"
                               class="btn btn-secondary">

                                <i class="zmdi zmdi-arrow-left"></i>

                                Back to List

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection

@else
    @php
        abort(403);
    @endphp
@endcan