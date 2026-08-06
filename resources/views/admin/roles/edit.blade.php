@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')

<section class="content">
   <div class="body_scroll">
      <div class="block-header">
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
               <h2>Edit Role</h2>

               <ul class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="{{ route('dashboard') }}">
                        <i class="zmdi zmdi-home"></i> Dashboard
                     </a>
                  </li>

                  <li class="breadcrumb-item">
                     <a href="{{ route('roles.index') }}"> Roles </a>
                  </li>

                  <li class="breadcrumb-item active">Edit Role</li>
               </ul>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
               <a href="{{ route('roles.index') }}" class="btn btn-danger">
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

         <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="row clearfix">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="header">
                        <h2><strong>Edit</strong> Role</h2>
                     </div>

                     <div class="body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>
                                    Role Name
                                    <span class="text-danger">*</span>
                                 </label>

                                 <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Role Name"
                                    value="{{ old('name', $role->name) }}"
                                 >

                                 @error('name')
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
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                           Cancel
                        </a>

                        <button type="submit" class="btn btn-success">
                           <i class="zmdi zmdi-save"></i>
                           Update Role
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
