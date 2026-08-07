@extends('layouts.app')

@section('title', 'Create Brand')

@section('content')

<section class="content">
   <div class="body_scroll">
      <div class="block-header">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
               <h2>Create Brand</h2>

               <ul class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="{{ route('dashboard') }}">
                        <i class="zmdi zmdi-home"></i> Dashboard
                     </a>
                  </li>

                  <li class="breadcrumb-item">
                     <a href="{{ route('brands.index') }}"> Brands </a>
                  </li>

                  <li class="breadcrumb-item active">Create Brand</li>
               </ul>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
               <a href="{{ route('brands.index') }}" class="btn btn-danger">
                  <i class="zmdi zmdi-arrow-left"></i>
                  Back
               </a>
            </div>
         </div>
      </div>

      <div class="container-fluid">
         <form id="brand-create-form" method="POST" action="{{ route('brands.store') }}">
            @csrf

            <div class="row clearfix">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="header">
                        <h2><strong>Create</strong> Brand</h2>
                     </div>

                     <div class="body">
                        <div class="row">
                           <!-- Brand Name -->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                    Brand Name
                                    <span class="text-danger">*</span>
                                 </label>

                                 <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Brand Name"
                                    value="{{ old('name') }}"
                                 >

                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>

                           <!-- Brand Code -->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                    Brand Code
                                    <span class="text-danger">*</span>
                                 </label>

                                 <input
                                    type="text"
                                    name="brand_code"
                                    class="form-control @error('brand_code') is-invalid @enderror"
                                    placeholder="Enter Brand Code"
                                    value="{{ old('brand_code') }}"
                                 >

                                 @error('brand_code')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>

                           <!-- Address Field -->
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>
                                    Address<span class="text-danger">*</span>
                                 </label>

                                 <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter Brand Address"
                                 >{{ old('address') }}</textarea>

                                 @error('address')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Buttons -->
               <div class="col-lg-12">
                  <div class="card">
                     <div class="body text-right">
                        <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                           Cancel
                        </a>

                        <button type="submit" class="btn btn-success">
                           <i class="zmdi zmdi-save"></i>
                           Create Brand
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
