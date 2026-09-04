<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Show create coupon form.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();

        return view('admin.coupons.create', compact('brands'));
    }

    public function index()
    {
        $coupons = Coupon::with('brand')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Store a new coupon.
     */
    public function store(Request $request, Coupon $coupon)
    {
        // dd($request->all());
        $validated = $request->validate([
            'brand_id' => ['nullable', 'exists:brands,id'],
            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('coupons', 'code')->ignore($coupon->id),
            ],
            'discount_type' => ['required', Rule::in(['percentage', 'flat'])],
            'discount_value' => ['required', 'numeric', 'min:0.01'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'minimum_order_amount' => ['nullable', 'numeric', 'min:0'],
            'maximum_discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_ads' => ['nullable', 'string'],
            'meta_keyword' => ['nullable', 'string'],
        ]);
        $validated['created_by'] = Auth::id();

        if (
            $validated['discount_type'] === 'percentage' &&
            $validated['discount_value'] > 100
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'discount_value' => 'Percentage discount cannot be greater than 100%.',
                ]);
        }

        if (
            $validated['discount_type'] === 'flat' &&
            ! empty($validated['maximum_discount'])
        ) {
            $validated['maximum_discount'] = null;
        }

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['used_count'] = 0;
        $validated['minimum_order_amount'] = $validated['minimum_order_amount'] ?? 0;
        $validated['status'] = $request->has('status') ? 1 : 0;

        Coupon::create($validated);

        return redirect()
            ->route('coupons.create')
            ->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $brands = Brand::orderBy('name')->get();

        return view('admin.coupons.edit', compact('coupon', 'brands'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'brand_id' => ['nullable', 'exists:brands,id'],
            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('coupons', 'code')->ignore($coupon->id),
            ],
            'discount_type' => ['required', Rule::in(['percentage', 'flat'])],
            'discount_value' => ['required', 'numeric', 'min:0.01'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'minimum_order_amount' => ['nullable', 'numeric', 'min:0'],
            'maximum_discount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_ads' => ['nullable', 'string'],
            'meta_keyword' => ['nullable', 'string'],
        ]);
        $validated['updated_by'] = Auth::id();

        if (
            $validated['discount_type'] === 'percentage' &&
            $validated['discount_value'] > 100
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'discount_value' => 'Percentage discount cannot be greater than 100%.',
                ]);
        }

        if (
            $validated['discount_type'] === 'flat' &&
            ! empty($validated['maximum_discount'])
        ) {
            $validated['maximum_discount'] = null;
        }

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['minimum_order_amount'] = $validated['minimum_order_amount'] ?? 0;
        $validated['status'] = $request->has('status') ? 1 : 0;

        $coupon->update($validated);

        return redirect()
            ->route('coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->update([
            'status' => 0,
        ]);

        return redirect()
            ->route('coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}
