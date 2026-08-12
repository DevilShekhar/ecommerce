<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('category')->latest()->get();
        return view('admin.offer.index', compact('offers'));
    }

    public function create()
    {
        $categories = OfferCategory::where('status', 1)->get();
        return view('admin.offer.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer_category_id' => 'required|exists:offer_categories,id',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'status'            => 'required|boolean',
        ]);

        Offer::create($request->only([
            'offer_category_id',
            'title',
            'description',
            'status'
        ]));

        return redirect()
            ->route('admin.offer.index')
            ->with('success', 'Offer created successfully.');
    }

    public function edit(Offer $offer)
    {
        $categories = OfferCategory::where('status', 1)->get();
        return view('admin.offer.edit', compact('offer', 'categories'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'offer_category_id' => 'required|exists:offer_categories,id',
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'status'            => 'required|boolean',
        ]);

        $offer->update($request->only([
            'offer_category_id',
            'title',
            'description',
            'status'
        ]));

        return redirect()
            ->route('admin.offer.index')
            ->with('success', 'Offer updated successfully.');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()
            ->route('admin.offer.index')
            ->with('success', 'Offer deleted successfully.');
    }
}