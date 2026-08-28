@can('user-index')
@extends('layouts.app')

@section('title', 'Users')

    @section('content')

        <section class="content">
            <div class="body_scroll">

                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2>Users</h2>

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <i class="zmdi zmdi-home"></i> Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Users</li>
                            </ul>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="zmdi zmdi-plus"></i>
                                Create User
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="card">
                        <div class="header">
                            <h2><strong>User</strong> List</h2>
                        </div>

                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="60">SrNo.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Assigned Role</th>
                                            <th>Status</th>
                                            <th width="180">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($users as $key => $user)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>{{ $user->name }}</td>

                                                <td>{{ $user->email }}</td>

                                                <td style="max-width: 250px;">
                                                    @php
                                                        $addresses = $user->address;

                                                        // Handle old JSON string data
                                                        if (is_string($addresses) && !empty($addresses)) {
                                                            $addresses = json_decode($addresses, true);
                                                        }

                                                        $addresses = is_array($addresses) ? $addresses : [];
                                                    @endphp

                                                    @if(count($addresses))
                                                        <ul class="mb-0 pl-3" style="padding-left: 18px;">
                                                            @foreach($addresses as $addr)
                                                                @php
                                                                    $fullAddress = collect([
                                                                        $addr['address'] ?? null,
                                                                        $addr['city'] ?? null,
                                                                        $addr['state'] ?? null,
                                                                        $addr['country'] ?? null,
                                                                        $addr['pincode'] ?? null,
                                                                    ])->filter(fn($value) => filled($value))->implode(', ');
                                                                @endphp

                                                                <li data-toggle="tooltip" data-placement="top" title="{{ $fullAddress }}"
                                                                    style="cursor: pointer; margin-bottom: 5px;">
                                                                    <strong>{{ $addr['type'] ?? 'Address' }}</strong> -
                                                                    {{ \Illuminate\Support\Str::limit($fullAddress, 35) }}

                                                                    @if(!empty($addr['is_default']))
                                                                        <span class="badge badge-success ml-1">Default</span>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $user->role->name ?? '-' }}
                                                </td>

                                                <td>
                                                    @if($user->status)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{-- Edit --}}
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"
                                                        title="Edit User">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>

                                                    {{-- Send Offer - Only for Customer Users --}}
                                                    @if($user->role?->name === 'customer')
                                                        <button type="button" class="btn btn-sm btn-info send-offer-btn"
                                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                                            data-toggle="modal" data-target="#sendOfferModal" title="Send Offer">
                                                            <i class="zmdi zmdi-local-offer"></i>
                                                        </button>
                                                    @endif

                                                    {{-- Delete --}}
                                                    @if($user->status == 1)
                                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                            class="d-inline delete-form" data-user-name="{{ $user->name }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                title="Delete User">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    No users found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div class="modal fade" id="sendOfferModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form action="{{ route('users.send-offer') }}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" id="offer_user_id">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="zmdi zmdi-local-offer"></i>
                                Send Offer
                            </h5>

                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            {{-- Offer --}}
                            <div class="form-group">
                                <label>
                                    Select Offer
                                </label>

                                <select name="offer_id" class="form-control">
                                    <option value="">-- Select Offer --</option>

                                    @foreach($offers as $offer)
                                        <option value="{{ $offer->id }}">
                                            {{ $offer->title }}
                                            @if($offer->discount_type === 'percentage')
                                                - {{ $offer->discount_value }}% OFF
                                            @else
                                                - ₹{{ number_format($offer->discount_value, 2) }} OFF
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Coupon Code --}}
                            <div class="form-group">
                                <label>
                                    Coupon Code
                                </label>

                                <select name="coupon_code" class="form-control">
                                    <option value="">-- No Coupon --</option>

                                    @foreach($coupons as $coupon)
                                        <option value="{{ $coupon->code }}">
                                            {{ $coupon->code }}

                                            @if($coupon->discount_type === 'percentage')
                                                - {{ $coupon->discount_value }}% OFF
                                            @else
                                                - ₹{{ number_format($coupon->discount_value, 2) }} OFF
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                <small class="form-text text-muted">
                                    Leave blank if no coupon is required.
                                </small>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <i class="zmdi zmdi-mail-send"></i>
                                Send Offer
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function () {

                $('.send-offer-btn').on('click', function () {

                    let userId = $(this).data('user-id');
                    let userName = $(this).data('user-name');

                    $('#offer_user_id').val(userId);
                    $('#offer_user_name').text(userName);

                });

            });
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush
@else
@php
    abort(403);
@endphp
@endcan
