<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display all offers.
     */
    public function index()
    {
        $offers = Offer::with(['category', 'productCategory', 'product'])
            ->latest()
            ->get();

        return view('admin.offer.index', compact('offers'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $categories = OfferCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        $productCategories = ProductCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.offer.create', compact('categories', 'productCategories'));
    }

    /**
     * Store offer.
     */
    public function store(Request $request)
    {
        $validated = $this->validateOffer($request);

        // Clean fields based on apply_to
        if ($validated['apply_to'] === 'category') {
            $validated['product_id'] = null;
        }

        Offer::create($validated);

        return redirect()
            ->route('admin.offer.index')
            ->with('success', 'Offer created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Offer $offer)
    {
        $categories = OfferCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        $productCategories = ProductCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        // Pre-load products when editing a product-level offer
        $products = collect();
        if ($offer->apply_to === 'product' && $offer->product_category_id) {
            $products = Product::where('category_id', $offer->product_category_id)
                ->where('status', 1)
                ->orderBy('name')
                ->get();
        }

        return view('admin.offer.edit', compact(
            'offer',
            'categories',
            'productCategories',
            'products'
        ));
    }

    /**
     * Update offer.
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $this->validateOffer($request);

        // Clean fields based on apply_to
        if ($validated['apply_to'] === 'category') {
            $validated['product_id'] = null;
        }

        $offer->update($validated);

        return redirect()
            ->route('admin.offer.index')
            ->with('success', 'Offer updated successfully.');
    }

    /**
     * Soft delete (set status = 0).
     */
    public function destroy(Offer $offer)
    {
        $offer->update([
            'status' => 0,
        ]);

        return redirect()
            ->route('admin.offer.index')
            ->with('success', 'Offer deleted successfully.');
    }

    /**
     * AJAX: Get products by Product Category
     */
    public function getProductsByCategory(Request $request)
    {
        try {
            $request->validate([
                'product_category_id' => 'required|exists:product_categories,id',
            ]);

            $products = Product::where('category_id', $request->product_category_id)
                ->where('status', 1)
                ->orderBy('name')
                ->get(['id', 'name']);

            // Log the data for debugging
            \Log::info('Products fetched:', ['count' => $products->count(), 'products' => $products->toArray()]);

            return response()->json($products);

        } catch (\Exception $e) {
            \Log::error('Error in getProductsByCategory:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'error' => 'An error occurred: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Shared validation logic
     */
    private function validateOffer(Request $request): array
    {
        $rules = [
            'offer_category_id' => ['required', 'exists:offer_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'apply_to' => ['required', 'in:category,product'],
            'product_category_id' => ['nullable', 'exists:product_categories,id'],
            'product_id' => ['nullable', 'exists:products,id'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'boolean'],
        ];

        // Conditional rules based on apply_to
        if ($request->apply_to === 'category') {
            $rules['product_category_id'] = ['required', 'exists:product_categories,id'];
            $rules['product_id'] = ['nullable'];
        }

        if ($request->apply_to === 'product') {
            $rules['product_category_id'] = ['required', 'exists:product_categories,id'];
            $rules['product_id'] = ['required', 'exists:products,id'];
        }

        $validated = $request->validate($rules);

        // Percentage cannot be more than 100
        if (
            $request->discount_type === 'percentage' &&
            $request->discount_value > 100
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'discount_value' => 'Percentage discount cannot be greater than 100%.',
                ])
                ->throwResponse();
        }

        // Extra safety: product must belong to selected category
        if ($request->apply_to === 'product' && $request->filled('product_id')) {
            $product = Product::find($request->product_id);

            if (! $product || $product->category_id != $request->product_category_id) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'product_id' => 'Selected product does not belong to the chosen category.',
                    ])
                    ->throwResponse();
            }
        }

        return $validated;
    }
}
