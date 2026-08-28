@extends('frontend.layouts.customer-layout')

@section('title', 'Account Settings - ShopEase')
@section('styles')
    <style>
        /* ================================
           Address Modal Fix
        ================================= */

        .modal {
            z-index: 1060 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
            background-color: rgba(0, 0, 0, 0.55) !important;
        }

        .modal-backdrop.show {
            opacity: 1 !important;
        }

        .modal-dialog {
            margin: 1.75rem auto;
        }

        .modal-content {
            background: #ffffff !important;
            border: 0 !important;
            border-radius: 16px !important;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.18) !important;
            overflow: hidden;
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0f3;
            background: #ffffff;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .modal-title i {
            color: #0d6efd;
        }

        .modal-body {
            padding: 24px;
            background: #ffffff;
        }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #edf0f3;
            background: #ffffff;
        }

        .modal .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .modal .form-control,
        .modal .form-select {
            min-height: 44px;
            border: 1px solid #dfe3e8;
            border-radius: 8px;
            background: #fff;
            color: #212529;
            box-shadow: none;
            transition: all 0.2s ease;
        }

        .modal textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        .modal .form-control:focus,
        .modal .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.10);
        }

        .modal .btn-primary {
            min-height: 42px;
            padding: 9px 18px;
            border-radius: 8px;
            font-weight: 500;
        }

        .modal .btn-light {
            min-height: 42px;
            padding: 9px 18px;
            border-radius: 8px;
            border: 1px solid #e1e5e9;
            background: #f8f9fa;
        }

        .modal .btn-light:hover {
            background: #eef0f2;
        }

        .modal .form-check {
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e9edf2;
            border-radius: 8px;
        }

        .modal .form-check-input {
            margin-top: 0.2em;
        }

        .modal .form-check-label {
            font-size: 14px;
            color: #4b5563;
            cursor: pointer;
        }

        /* Prevent page from appearing completely black */
        body.modal-open {
            overflow: hidden;
        }

        /* Mobile */
        @media (max-width: 767px) {
            .modal-dialog {
                margin: 12px;
            }

            .modal-header {
                padding: 16px 18px;
            }

            .modal-body {
                padding: 18px;
            }

            .modal-footer {
                padding: 14px 18px;
            }

            .modal-title {
                font-size: 16px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="account-page">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->has('address'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $errors->first('address') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any() && !$errors->has('address'))
            <div class="alert alert-danger">
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('account.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="settings-card">
                <div class="settings-header">
                    <div class="settings-icon"><i class="bi bi-person"></i></div>
                    <div>
                        <h5>Account Settings</h5>
                        <p>Manage your personal account information</p>
                    </div>
                </div>
                <div class="profile-image-area">
                    <div class="profile-avatar" id="avatarPreview">
                        {{ strtoupper(substr(trim($user->name), 0, 1)) }}
                    </div>
                    <div class="avatar-content">
                        <h6>Profile Picture</h6>
                        <p>Upload JPG, PNG or WEBP image. Maximum size 2MB.</p>

                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" placeholder="Enter your full name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" placeholder="Enter your email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>

        <div class="settings-card">
            <div class="settings-header">
                <div class="settings-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h5>Change Password</h5>
                    <p>Update your password to keep your account secure</p>
                </div>
            </div>

            <form action="{{ route('account.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            New Password <span class="required">*</span>
                        </label>

                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter new password" minlength="8" required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Password must be at least 8 characters.
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Confirm Password <span class="required">*</span>
                        </label>

                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm new password" minlength="8" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-key me-1"></i>
                            Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="settings-card">
            <div class="settings-header">
                <div class="settings-icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <h5>Delivery Addresses</h5>
                    <p>Manage your saved delivery addresses</p>
                </div>
            </div>
            <div class="row g-3">
                @forelse($addresses as $address)
                    @php
                        $addressId = $address['id'] ?? null;
                        $isDefault = !empty($address['is_default']);
                    @endphp
                    <div class="col-md-6">
                        <div class="address-card h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $address['type'] ?? 'Address' }}</h6>
                                    @if($isDefault)
                                        <span class="badge bg-success">Default</span>
                                    @endif
                                </div>
                                @if($addressId)
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if(!$isDefault)
                                                <li>
                                                    <form method="POST" action="{{ route('account.addresses.default', $addressId) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bi bi-check-circle me-2"></i>Make Default
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editAddressModal{{ $addressId }}">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('account.addresses.delete', $addressId) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete this address?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="address-details">
                                <div class="fw-semibold mb-1">{{ $address['name'] ?? '' }}</div>
                                @if(!empty($address['mobile']))
                                    <div class="text-muted small mb-2">
                                        <i class="bi bi-telephone me-1"></i>{{ $address['mobile'] }}
                                    </div>
                                @endif
                                <div class="text-muted small">
                                    {{ $address['address'] ?? '' }}
                                    @if(!empty($address['city']))
                                        <br>{{ $address['city'] }}
                                    @endif
                                    @if(!empty($address['state']))
                                        , {{ $address['state'] }}
                                    @endif
                                    @if(!empty($address['pincode']))
                                        - {{ $address['pincode'] }}
                                    @endif
                                    @if(!empty($address['country']))
                                        <br>{{ $address['country'] }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($addressId)
                        <div class="modal fade" id="editAddressModal{{ $addressId }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('account.addresses.update', $addressId) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Address</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Address Type</label>
                                                    <select name="address_type" class="form-control">
                                                        <option value="Home" {{ ($address['type'] ?? '') === 'Home' ? 'selected' : '' }}>Home</option>
                                                        <option value="Office" {{ ($address['type'] ?? '') === 'Office' ? 'selected' : '' }}>Office</option>
                                                        <option value="Other" {{ ($address['type'] ?? '') === 'Other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $address['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Mobile</label>
                                                    <input type="text" name="mobile" class="form-control"
                                                        value="{{ $address['mobile'] ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Complete Address</label>
                                                    <textarea name="address" class="form-control"
                                                        rows="3">{{ $address['address'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">City</label>
                                                    <input type="text" name="city" class="form-control"
                                                        value="{{ $address['city'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">State</label>
                                                    <input type="text" name="state" class="form-control"
                                                        value="{{ $address['state'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Country</label>
                                                    <input type="text" name="country" class="form-control"
                                                        value="{{ $address['country'] ?? 'India' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Pincode</label>
                                                    <input type="text" name="pincode" class="form-control"
                                                        value="{{ $address['pincode'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update
                                                Address</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12">
                        <div class="empty-address text-center py-4">
                            <i class="bi bi-geo-alt display-5 text-muted"></i>
                            <h6 class="mt-3">No Address Added</h6>
                            <p class="text-muted mb-0">Add an address for faster checkout.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-4">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#addAddressModal">
                    <i class="bi bi-plus-lg me-1"></i>Add Address
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-4">
            <button type="submit" form="accountSettingsForm" class="btn btn-save">
                <i class="bi bi-check-lg me-1"></i>Save Changes
            </button>
        </div>
    </div>

    <div class="modal fade" id="addAddressModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('account.addresses.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-geo-alt me-2"></i>Add New Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Address Type <span class="required">*</span></label>
                                <select name="address_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span class="required">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile <span class="required">*</span></label>
                                <input type="text" name="mobile" class="form-control" value="{{ $user->mobile ?? '' }}"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Complete Address <span class="required">*</span></label>
                                <textarea name="address" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City <span class="required">*</span></label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State <span class="required">*</span></label>
                                <input type="text" name="state" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country <span class="required">*</span></label>
                                <input type="text" name="country" class="form-control" value="India" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pincode <span class="required">*</span></label>
                                <input type="text" name="pincode" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_default" value="1"
                                        id="isDefault">
                                    <label class="form-check-label" for="isDefault">Make this my default address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Add Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');
            if (avatarInput && avatarPreview) {
                avatarInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview">`;
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
@endsection
