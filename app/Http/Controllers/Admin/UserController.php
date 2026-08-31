<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Role;
use App\Models\User;
use App\Models\UserOffer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function index()
    {
        $users = User::all();
        $offers = Offer::with([
            'category',
            'productCategory',
            'product',
        ])
            ->where('status', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->get();
        $coupons = Coupon::query()->where('status', 1)
            ->whereDate('start_date', '<=', now()->toDateString())
            ->whereDate('end_date', '>=', now()->toDateString())
            ->orderBy('code')
            ->get();

        return view('admin.users.index', compact('users', 'offers', 'coupons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'address' => 'nullable|string|max:1000',
            'role_id' => 'nullable|exists:roles,id',
        ]);
        $validated['status'] = 1;

        $newUser = User::create($validated);

        $newUser->assignRole(Role::findOrFail($validated['role_id']));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'address' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'role_id' => 'nullable|exists:roles,id',
        ]);
        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->update([
            'status' => 0,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User deactivated successfully.');
    }

    public function sendOffer(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'offer_id' => ['nullable', 'exists:offers,id'],
            'coupon_code' => ['nullable', 'string', 'max:100'],
        ]);

        UserOffer::create([
            'user_id' => $request->user_id,
            'offer_id' => $request->offer_id,
            'coupon_code' => $request->filled('coupon_code')
                ? strtoupper(trim($request->coupon_code))
                : null,
            'status' => 1,
            'sent_at' => now(),
        ]);

        return back()->with('success', 'Offer/Coupon sent successfully.');
    }
}
