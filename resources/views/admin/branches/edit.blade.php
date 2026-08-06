@extends('layouts.app')

@section('title', 'Edit Branch')

@section('content')

<section class="content">
   <div class="body_scroll">
      <div class="block-header">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
               <h2>Edit Branch</h2>

               <ul class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="{{ route('dashboard') }}">
                        <i class="zmdi zmdi-home"></i> Dashboard
                     </a>
                  </li>

                  <li class="breadcrumb-item">
                     <a href="{{ route('branches.index') }}"> Branches </a>
                  </li>

                  <li class="breadcrumb-item active">Edit Branch</li>
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

         <form method="POST" action="{{ route('branches.update', $branch->id) }}">
            @csrf
            @method('PUT')

            <div class="row clearfix">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="header">
                        <h2><strong>Edit</strong> Branch</h2>
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
                                    value="{{ old('name', $branch->name) }}"
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
                                    value="{{ old('code', $branch->code) }}"
                                 >

                                 @error('code')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                              </div>
                           </div>

                           <!-- Status -->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                    Status
                                    <span class="text-danger">*</span>
                                 </label>

                                 <select name="status" class="form-control show-tick @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', $branch->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $branch->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                 </select>

                                 @error('status')
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
                           Update Branch
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