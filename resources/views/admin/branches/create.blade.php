@extends('layouts.app')

@section('title', 'Create Branch')

@section('content')

<section class="content">
   <div class="body_scroll">
      <div class="block-header">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
               <h2>Create Branch</h2>

               <ul class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="{{ route('dashboard') }}">
                        <i class="zmdi zmdi-home"></i> Dashboard
                     </a>
                  </li>

                  <li class="breadcrumb-item">
                     <a href="{{ route('branches.index') }}"> Branches </a>
                  </li>

                  <li class="breadcrumb-item active">Create Branch</li>
               </ul>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
               <a href="{{ route('branches.index') }}" class="btn btn-danger">
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

         <form id="branch-create-form" method="POST" action="{{ route('branches.store') }}">
            @csrf

            <div class="row clearfix">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="header">
                        <h2><strong>Create</strong> Branch</h2>
                     </div>

                     <div class="body">
                        <div class="row">
                           <!-- Branch Name -->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                    Branch Name
                                    <span class="text-danger">*</span>
                                 </label>

                                 <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Branch Name"
                                    value="{{ old('name') }}"
                                 >

                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>

                           <!-- Branch Code -->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                    Branch Code
                                    <span class="text-danger">*</span>
                                 </label>

                                 <input
                                    type="text"
                                    name="code"
                                    class="form-control @error('code') is-invalid @enderror"
                                    placeholder="Enter Branch Code"
                                    value="{{ old('code') }}"
                                 >

                                 @error('code')
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
                                    Address
                                 </label>

                                 <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Enter Branch Address"
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
                        <a href="{{ route('branches.index') }}" class="btn btn-secondary">
                           Cancel
                        </a>

                        <button type="submit" class="btn btn-success">
                           <i class="zmdi zmdi-save"></i>
                           Create Branch
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