@extends('layouts.app')

@section('title', 'Manage Permissions - ' . $role->name)

@section('content')
<section class="content">
    <div class="body_scroll">

        <!-- Header & Breadcrumbs -->
        <div class="block-header mb-4">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2 class="font-weight-bold text-dark mb-1">Role Permissions</h2>
                    <p class="text-muted mb-0">Configure operational access for <span class="badge badge-primary px-2 py-1">{{ $role->name }}</span></p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-round">
                        <i class="zmdi zmdi-arrow-left mr-1"></i> Back to Roles
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid px-0">

            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="zmdi zmdi-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="zmdi zmdi-alert-triangle mr-2"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST" id="permissions-form">
                @csrf
                @method('PUT')

                <!-- Control Bar: Search & Global Select -->
                <div class="card border-0 shadow-sm mb-4 search-control-card">
                    <div class="body p-3">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-right-0"><i class="zmdi zmdi-search text-muted"></i></span>
                                    </div>
                                    <input type="text" id="permission-search" class="form-control border-left-0 pl-0"
                                           placeholder="Search modules or permissions (e.g., user, create, edit)...">
                                </div>
                            </div>
                            <div class="col-md-5 text-md-right mt-3 mt-md-0">
                                <div class="custom-control custom-checkbox d-inline-block">
                                    <input type="checkbox" class="custom-control-input" id="global-select-all">
                                    <label class="custom-control-label font-weight-bold text-dark cursor-pointer" for="global-select-all">
                                        Select All Permissions
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $grouped = [];
                    foreach ($permissions as $permission) {
                        $cleanName = str_replace(['.', '_', '-'], ' ', $permission->name);
                        $parts = explode(' ', $cleanName);
                        $module = ucfirst($parts[0] ?? 'General');
                        $grouped[$module][] = $permission;
                    }
                    ksort($grouped);
                @endphp

                <!-- Grouped Permissions Matrix -->
                <div class="row clearfix" id="permission-groups">

                    @forelse($grouped as $module => $modulePermissions)
                        <div class="col-lg-6 col-md-12 permission-group mb-4" data-module="{{ strtolower($module) }}">
                            <div class="card border-0 shadow-sm h-100 module-card">

                                <!-- Category Header -->
                                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="module-icon-badge mr-2">
                                            <i class="zmdi zmdi-folder-star-alt text-primary"></i>
                                        </span>
                                        <h6 class="mb-0 font-weight-bold text-capitalize text-dark">{{ $module }}</h6>
                                        <span class="badge badge-light badge-pill ml-2 text-muted border">
                                            {{ count($modulePermissions) }}
                                        </span>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input group-select-all"
                                               id="group-{{ strtolower($module) }}" data-group="{{ strtolower($module) }}">
                                        <label class="custom-control-label text-muted small cursor-pointer" for="group-{{ strtolower($module) }}">
                                            Select Category
                                        </label>
                                    </div>
                                </div>

                                <!-- Permissions Grid -->
                                <div class="body p-3">
                                    <div class="row">
                                        @foreach($modulePermissions as $permission)
                                            @php
                                                $displayName = ucwords(str_replace(['.', '_', '-'], ' ', $permission->name));
                                                $isChecked = in_array($permission->name, $rolePermissions ?? []);
                                            @endphp
                                            <div class="col-12 permission-item mb-2"
                                                 data-name="{{ strtolower($permission->name) }}"
                                                 data-display="{{ strtolower($displayName) }}">

                                                <label class="permission-card-option d-flex align-items-center p-2 rounded {{ $isChecked ? 'active' : '' }}">
                                                    <div class="custom-control custom-checkbox mr-3">
                                                        <input type="checkbox"
                                                               class="custom-control-input permission-checkbox"
                                                               id="perm-{{ $permission->id }}"
                                                               name="permissions[]"
                                                               value="{{ $permission->name }}"
                                                               data-group="{{ strtolower($module) }}"
                                                               {{ $isChecked ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="perm-{{ $permission->id }}"></label>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="permission-title font-weight-bold text-dark small">
                                                            {{ $displayName }}
                                                        </div>
                                                        <code class="text-muted extra-small">{{ $permission->name }}</code>
                                                    </div>
                                                </label>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm py-5 text-center">
                                <div class="body">
                                    <i class="zmdi zmdi-shield-security zmdi-hc-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No permission records found in system.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>

                <!-- Search No Results Container -->
                <div id="no-results" class="card border-0 shadow-sm d-none">
                    <div class="body text-center py-5">
                        <i class="zmdi zmdi-search-for text-muted zmdi-hc-3x mb-2"></i>
                        <h6 class="text-muted">No matching permissions found</h6>
                    </div>
                </div>

                <!-- Sticky Footer Actions Bar -->
                <div class="sticky-footer-bar">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator mr-2"></div>
                                <span class="font-weight-bold text-dark mr-1" id="selected-count">0</span>
                                <span class="text-muted">permissions active</span>
                            </div>
                            <div>
                                <a href="{{ route('roles.index') }}" class="btn btn-link text-muted mr-2">Cancel</a>
                                <button type="submit" class="btn btn-success px-4 btn-round shadow-sm">
                                    <i class="zmdi zmdi-check mr-1"></i> Save Changes
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

@section('styles')
<style>
    .cursor-pointer { cursor: pointer; }
    .extra-small { font-size: 11px; }

    .module-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 8px;
    }

    .module-card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    }

    .module-icon-badge {
        background: #f0f4f8;
        padding: 4px 8px;
        border-radius: 6px;
    }

    .permission-card-option {
        border: 1px solid #eef2f5;
        background-color: #fafbfc;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .permission-card-option:hover {
        background-color: #ffffff;
        border-color: #28a745;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }

    .permission-card-option.active {
        background-color: #f2f9f4;
        border-color: #28a745;
    }

    .permission-card-option.active .permission-title {
        color: #1e7e34 !important;
    }

    .sticky-footer-bar {
        position: sticky;
        bottom: 1rem;
        background: #ffffff;
        border: 1px solid #e0e6ed;
        padding: 12px 20px;
        border-radius: 10px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        z-index: 99;
        margin-top: 30px;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        background-color: #28a745;
        border-radius: 50%;
        display: inline-block;
    }

    .permission-card-option .custom-checkbox {
        padding-left: 1.25rem;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const globalSelectAll   = document.getElementById('global-select-all');
        const groupSelectAlls   = document.querySelectorAll('.group-select-all');
        const checkboxes        = document.querySelectorAll('.permission-checkbox');
        const searchInput       = document.getElementById('permission-search');
        const selectedCountEl   = document.getElementById('selected-count');
        const noResultsEl       = document.getElementById('no-results');

        function toggleOptionCardState(checkbox) {
            const card = checkbox.closest('.permission-card-option');
            if (card) {
                if (checkbox.checked) {
                    card.classList.add('active');
                } else {
                    card.classList.remove('active');
                }
            }
        }

        function updateSelectedCount() {
            const count = document.querySelectorAll('.permission-checkbox:checked').length;
            selectedCountEl.textContent = count;
        }

        globalSelectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => {
                if (!cb.closest('.permission-item').classList.contains('d-none')) {
                    cb.checked = this.checked;
                    toggleOptionCardState(cb);
                }
            });

            groupSelectAlls.forEach(g => {
                if (!g.closest('.permission-group').classList.contains('d-none')) {
                    g.checked = this.checked;
                    g.indeterminate = false;
                }
            });

            updateSelectedCount();
        });

        groupSelectAlls.forEach(groupCb => {
            groupCb.addEventListener('change', function () {
                const group = this.dataset.group;
                document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`).forEach(cb => {
                    if (!cb.closest('.permission-item').classList.contains('d-none')) {
                        cb.checked = this.checked;
                        toggleOptionCardState(cb);
                    }
                });
                updateGlobalSelectAllState();
                updateSelectedCount();
            });
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                toggleOptionCardState(this);
                updateGroupSelectAllState(this.dataset.group);
                updateGlobalSelectAllState();
                updateSelectedCount();
            });
        });

        function updateGroupSelectAllState(group) {
            const groupCbs = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
            const groupSelect = document.querySelector(`.group-select-all[data-group="${group}"]`);
            if (!groupSelect) return;

            const visibleCbs = Array.from(groupCbs).filter(cb => !cb.closest('.permission-item').classList.contains('d-none'));
            const checkedCount = visibleCbs.filter(cb => cb.checked).length;

            groupSelect.checked = checkedCount === visibleCbs.length && visibleCbs.length > 0;
            groupSelect.indeterminate = checkedCount > 0 && checkedCount < visibleCbs.length;
        }

        function updateGlobalSelectAllState() {
            const visibleCbs = Array.from(checkboxes).filter(cb => !cb.closest('.permission-item').classList.contains('d-none'));
            const checkedCount = visibleCbs.filter(cb => cb.checked).length;

            globalSelectAll.checked = checkedCount === visibleCbs.length && visibleCbs.length > 0;
            globalSelectAll.indeterminate = checkedCount > 0 && checkedCount < visibleCbs.length;
        }

        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase().trim();
            let totalVisibleGroups = 0;

            document.querySelectorAll('.permission-item').forEach(item => {
                const name = item.dataset.name;
                const display = item.dataset.display;
                const match = name.includes(term) || display.includes(term);
                item.classList.toggle('d-none', !match);
            });

            document.querySelectorAll('.permission-group').forEach(group => {
                const visibleItems = group.querySelectorAll('.permission-item:not(.d-none)');
                const isGroupVisible = visibleItems.length > 0;
                group.classList.toggle('d-none', !isGroupVisible);
                if (isGroupVisible) totalVisibleGroups++;
            });

            if (noResultsEl) {
                noResultsEl.classList.toggle('d-none', totalVisibleGroups > 0);
            }

            groupSelectAlls.forEach(g => updateGroupSelectAllState(g.dataset.group));
            updateGlobalSelectAllState();
        });

        checkboxes.forEach(cb => toggleOptionCardState(cb));
        groupSelectAlls.forEach(g => updateGroupSelectAllState(g.dataset.group));
        updateGlobalSelectAllState();
        updateSelectedCount();
    });
</script>
@endsection
