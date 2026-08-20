@extends('layouts.app')

@section('title', 'Add Offer')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Add Offer</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.offer.index') }}">Offers</a>
                        </li>
                        <li class="breadcrumb-item active">Add</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('admin.offer.index') }}" class="btn btn-danger">
                        <i class="zmdi zmdi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Create</strong> New Offer</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.offer.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Offer Category <span class="text-danger">*</span></label>
                                    <select name="offer_category_id" id="offer_category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('offer_category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                        <option value="other" {{ old('offer_category_id') == 'other' ? 'selected' : '' }}>
                                            Other (Add New)
                                        </option>
                                    </select>
                                    @error('offer_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group" id="new_category_wrapper" style="display: none;">
                                    <label>New Offer Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="new_offer_category" id="new_offer_category"
                                           class="form-control" value="{{ old('new_offer_category') }}"
                                           placeholder="Enter new category name">
                                    @error('new_offer_category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control"
                                           value="{{ old('title') }}" required>
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Apply Offer To <span class="text-danger">*</span></label>
                                    <select name="apply_to" id="apply_to" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="category" {{ old('apply_to') == 'category' ? 'selected' : '' }}>
                                            Product Category
                                        </option>
                                        <option value="product" {{ old('apply_to') == 'product' ? 'selected' : '' }}>
                                            Product
                                        </option>
                                    </select>
                                    @error('apply_to')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group" id="product_category_wrapper" style="display:none;">
                                    <label>Product Category <span class="text-danger">*</span></label>
                                    <select name="product_category_id" id="product_category_id" class="form-control">
                                        <option value="">Select Product Category</option>
                                        @foreach($productCategories as $pc)
                                            <option value="{{ $pc->id }}" {{ old('product_category_id') == $pc->id ? 'selected' : '' }}>
                                                {{ $pc->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group" id="product_wrapper" style="display:none;">
                                    <label>Product <span class="text-danger">*</span></label>
                                    <select name="product_id" id="product_id" class="form-control">
                                        <option value="">Select Product</option>
                                    </select>
                                    @error('product_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Type <span class="text-danger">*</span></label>
                                            <select name="discount_type" id="discount_type" class="form-control" required>
                                                <option value="">Select Discount Type</option>
                                                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>
                                                    Percentage (%)
                                                </option>
                                                <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>
                                                    Fixed Amount
                                                </option>
                                            </select>
                                            @error('discount_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Discount Value <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" name="discount_value" class="form-control"
                                                       value="{{ old('discount_value') }}" min="0" step="0.01"
                                                       placeholder="Enter discount" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="discountSymbol">%</span>
                                                </div>
                                            </div>
                                            @error('discount_value')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date <span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" class="form-control"
                                                   value="{{ old('start_date') }}" required>
                                            @error('start_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date <span class="text-danger">*</span></label>
                                            <input type="date" name="end_date" class="form-control"
                                                   value="{{ old('end_date') }}" required>
                                            @error('end_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="zmdi zmdi-plus"></i> Create Offer
                                    </button>
                                    <a href="{{ route('admin.offer.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/dist/summernote.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/admin/plugins/summernote/dist/summernote.js') }}"></script>
<script>
$(document).ready(function () {

    $('.summernote').summernote({
        height: 250,
        placeholder: 'Write offer description...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    function updateDiscountSymbol() {
        let type = $('#discount_type').val();
        $('#discountSymbol').text(type === 'fixed' ? '₹' : '%');
    }
    $('#discount_type').on('change', updateDiscountSymbol);
    updateDiscountSymbol();

    function toggleApplyFields() {
        let applyTo = $('#apply_to').val();

        if (applyTo === 'category') {
            $('#product_category_wrapper').show();
            $('#product_wrapper').hide();
            $('#product_category_id').prop('required', true);
            $('#product_id').prop('required', false);
        } else if (applyTo === 'product') {
            $('#product_category_wrapper').show();
            $('#product_wrapper').show();
            $('#product_category_id').prop('required', true);
            $('#product_id').prop('required', true);
        } else {
            $('#product_category_wrapper').hide();
            $('#product_wrapper').hide();
            $('#product_category_id').prop('required', false);
            $('#product_id').prop('required', false);
        }
    }

    $('#apply_to').on('change', function () {
        toggleApplyFields();
        $('#product_id').html('<option value="">Select Product</option>');
        if (typeof $.fn.selectpicker !== 'undefined') {
            $('#product_id').selectpicker('refresh');
        }
    });

    function loadProducts(categoryId, selectedId = null) {
        let $select = $('#product_id');

        if (!categoryId) {
            $select.html('<option value="">Select Product</option>');
            if (typeof $.fn.selectpicker !== 'undefined') {
                $select.selectpicker('refresh');
            }
            return;
        }

        $select.html('<option value="">Loading...</option>');
        if (typeof $.fn.selectpicker !== 'undefined') {
            $select.selectpicker('refresh');
        }

        $.ajax({
            url: "{{ route('admin.offer.products-by-category') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                product_category_id: categoryId
            },
            success: function (response) {
                let products = Array.isArray(response) ? response : (response.data || []);
                let html = '<option value="">Select Product</option>';

                if (products.length === 0) {
                    html = '<option value="">No products found</option>';
                } else {
                    for (let i = 0; i < products.length; i++) {
                        let p = products[i];
                        let selected = (selectedId && selectedId == p.id) ? 'selected' : '';
                        html += '<option value="' + p.id + '" ' + selected + '>' + p.name + '</option>';
                    }
                }

                $select.html(html);

                if (typeof $.fn.selectpicker !== 'undefined') {
                    $select.selectpicker('refresh');
                } else if (typeof $.fn.select2 !== 'undefined') {
                    $select.trigger('change');
                } else {
                    $select.trigger('change');
                }
            },
            error: function (xhr, status, error) {
                $select.html('<option value="">Error loading products</option>');
                if (typeof $.fn.selectpicker !== 'undefined') {
                    $select.selectpicker('refresh');
                }
            }
        });
    }

    $(document).on('change', '#product_category_id', function () {
        let catId = $(this).val();
        loadProducts(catId);
    });

    function toggleNewCategory() {
        if ($('#offer_category_id').val() === 'other') {
            $('#new_category_wrapper').show();
            $('#new_offer_category').prop('required', true);
        } else {
            $('#new_category_wrapper').hide();
            $('#new_offer_category').prop('required', false).val('');
        }
    }

    $('#offer_category_id').on('change', toggleNewCategory);

    toggleApplyFields();
    toggleNewCategory();

    @if(old('product_category_id'))
        loadProducts("{{ old('product_category_id') }}", "{{ old('product_id') }}");
    @endif
});
</script>
@endpush
