<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{
    public function index()
    {
        $categories = OfferCategory::latest()->get();
        return view('admin.offer-cat.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:offer_categories,name',
        ]);

        OfferCategory::create([
            'name'   => $request->name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()
            ->route('admin.offer-category.index')
            ->with('success', 'Offer Category created successfully.');
    }

    public function update(Request $request, OfferCategory $offerCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:offer_categories,name,' . $offerCategory->id,
        ]);

        $offerCategory->update([
            'name'   => $request->name,
            'status' => $request->status ?? 0,
        ]);

        return redirect()
            ->route('admin.offer-category.index')
            ->with('success', 'Offer Category updated successfully.');
    }

    public function destroy(OfferCategory $offerCategory)
    {
        $offerCategory->delete();

        return redirect()
            ->route('admin.offer-category.index')
            ->with('success', 'Offer Category deleted successfully.');
    }
}