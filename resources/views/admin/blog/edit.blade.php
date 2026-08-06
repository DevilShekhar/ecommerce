@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Edit Blog</h2>

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
                            Edit Blog
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('blogs.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('blogs.update',$blog->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row clearfix">

                    <!-- Blog Information -->
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Blog</strong> Information
                                </h2>
                            </div>

                            <div class="body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Blog Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                placeholder="Enter Blog Name"
                                                value="{{ old('name',$blog->name) }}">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                Blog Title
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                id="title"
                                                name="title"
                                                class="form-control"
                                                placeholder="Enter Blog Title"
                                                value="{{ old('title',$blog->title) }}">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Slug</label>

                                            <input
                                                type="text"
                                                id="slug"
                                                name="slug"
                                                class="form-control"
                                                readonly
                                                value="{{ old('slug',$blog->slug) }}">

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>Featured Image</label>

                                            <input
                                                type="file"
                                                name="image"
                                                id="image"
                                                class="form-control"
                                                accept="image/*">

                                        </div>

                                        @if($blog->image)

                                            <img
                                                id="preview-image"
                                                src="{{ asset('storage/'.$blog->image) }}"
                                                style="
                                                    width:180px;
                                                    border:1px solid #ddd;
                                                    padding:5px;
                                                    margin-top:10px;
                                                ">

                                        @else

                                            <img
                                                id="preview-image"
                                                src=""
                                                style="
                                                    display:none;
                                                    width:180px;
                                                    border:1px solid #ddd;
                                                    padding:5px;
                                                    margin-top:10px;
                                                ">

                                        @endif

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>
                                                Description
                                                <span class="text-danger">*</span>
                                            </label>

                                            <textarea
                                                name="description"
                                                id="description"
                                                rows="10"
                                                class="form-control"
                                                placeholder="Write Blog Description...">{{ old('description',$blog->description) }}</textarea>

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

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Meta Title</label>

                                            <input
                                                type="text"
                                                name="meta_title"
                                                class="form-control"
                                                placeholder="Enter Meta Title"
                                                value="{{ old('meta_title',$blog->meta_title) }}">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Meta Keywords</label>

                                            <input
                                                type="text"
                                                name="meta_keyword"
                                                class="form-control"
                                                placeholder="keyword1, keyword2, keyword3"
                                                value="{{ old('meta_keyword',$blog->meta_keyword) }}">

                                            <small class="text-muted">
                                                Separate keywords using commas.
                                            </small>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>Meta Description</label>

                                            <textarea
                                                name="meta_description"
                                                rows="4"
                                                class="form-control"
                                                placeholder="Enter Meta Description">{{ old('meta_description',$blog->meta_description) }}</textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FAQ Section -->
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="header">

                                <div class="d-flex justify-content-between align-items-center">

                                    <h2>
                                        <strong>Blog FAQ</strong>
                                    </h2>

                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm"
                                        id="addFaq">

                                        <i class="zmdi zmdi-plus"></i>

                                        Add FAQ

                                    </button>

                                </div>

                            </div>

                            <div class="body">

                                <div id="faqWrapper">

                                    @if($blog->faqs->count())

                                        @foreach($blog->faqs as $faq)

                                        <div class="faq-item border rounded p-3 mb-3">

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <label>Question</label>

                                                        <input
                                                            type="text"
                                                            name="question[]"
                                                            class="form-control"
                                                            placeholder="Enter FAQ Question"
                                                            value="{{ $faq->question }}">

                                                    </div>

                                                </div>

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <label>Answer</label>

                                                        <textarea
                                                            name="answer[]"
                                                            rows="4"
                                                            class="form-control"
                                                            placeholder="Enter FAQ Answer">{{ $faq->answer }}</textarea>

                                                    </div>

                                                </div>

                                                <div class="col-md-12 text-right">

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger removeFaq">

                                                        <i class="zmdi zmdi-delete"></i>

                                                        Remove

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                        @endforeach

                                    @else

                                        <div class="faq-item border rounded p-3 mb-3">

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <label>Question</label>

                                                        <input
                                                            type="text"
                                                            name="question[]"
                                                            class="form-control"
                                                            placeholder="Enter FAQ Question">

                                                    </div>

                                                </div>

                                                <div class="col-md-12">

                                                    <div class="form-group">

                                                        <label>Answer</label>

                                                        <textarea
                                                            name="answer[]"
                                                            rows="4"
                                                            class="form-control"
                                                            placeholder="Enter FAQ Answer"></textarea>

                                                    </div>

                                                </div>

                                                <div class="col-md-12 text-right">

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger removeFaq">

                                                        <i class="zmdi zmdi-delete"></i>

                                                        Remove

                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="body text-right">

                                <a
                                    href="{{ route('blogs.index') }}"
                                    class="btn btn-secondary">

                                    Cancel

                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-success">

                                    <i class="zmdi zmdi-save"></i>

                                    Update Blog

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</section>
@endsection

@section('scripts')
<script>

$(document).ready(function () {

    //==========================
    // Auto Generate Slug
    //==========================
    $('#title').on('keyup', function () {

        let slug = $(this).val()
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');

        $('#slug').val(slug);

    });

    //==========================
    // Image Preview
    //==========================
    $('#image').change(function (e) {

        if (e.target.files.length > 0) {

            let reader = new FileReader();

            reader.onload = function (event) {

                $('#preview-image')
                    .attr('src', event.target.result)
                    .show();

            }

            reader.readAsDataURL(e.target.files[0]);

        }

    });

    //==========================
    // Add FAQ
    //==========================
    $('#addFaq').click(function () {

        let html = `

        <div class="faq-item border rounded p-3 mb-3">

            <div class="row">

                <div class="col-md-12">

                    <div class="form-group">

                        <label>Question</label>

                        <input
                            type="text"
                            name="question[]"
                            class="form-control"
                            placeholder="Enter FAQ Question">

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">

                        <label>Answer</label>

                        <textarea
                            name="answer[]"
                            rows="4"
                            class="form-control"
                            placeholder="Enter FAQ Answer"></textarea>

                    </div>

                </div>

                <div class="col-md-12 text-right">

                    <button
                        type="button"
                        class="btn btn-danger removeFaq">

                        <i class="zmdi zmdi-delete"></i>

                        Remove

                    </button>

                </div>

            </div>

        </div>

        `;

        $('#faqWrapper').append(html);

    });

    //==========================
    // Remove FAQ
    //==========================
    $(document).on('click', '.removeFaq', function () {

        $(this).closest('.faq-item').remove();

    });

});

</script>



<script>

$(document).ready(function () {

    $('#description').summernote({

        height: 300,

        placeholder: 'Write Blog Description...'

    });

});

</script>

@endsection