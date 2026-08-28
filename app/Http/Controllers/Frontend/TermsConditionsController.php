<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TermsConditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $termsConditions = TermsConditions::where('status', 1)
            ->latest()
            ->get();

        return view(
            'frontend.terms-conditions.index',
            compact('termsConditions')
        );
    }

    public function adminIndex()
    {
        $termsConditions = TermsConditions::latest()->get();

        return view(
            'frontend.terms-conditions.admin-index',
            compact('termsConditions')
        );
    }

    public function create()
    {
        return view('frontend.terms-conditions.create');
    }

    public function store(Request $request)
    {
        // Check if we have items array or single fields
        if ($request->has('items') && is_array($request->input('items')) && count($request->input('items')) > 0) {
            // Multiple items validation
            $validated = $request->validate([
                'items' => 'required|array|min:1',
                'items.*.terms_conditions_category' => 'nullable|string|max:255',
                'items.*.terms_conditions_title' => 'required|string|max:255',
                'items.*.terms_conditions_subtitle' => 'nullable|string|max:255',
                'items.*.terms_conditions_descripton' => 'required|string',
                'items.*.terms_conditions_iamage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'items.*.status' => 'nullable|boolean',
            ]);

            $createdCount = 0;
            $errors = [];

            foreach ($request->input('items') as $index => $itemData) {
                try {
                    // Set status
                    $itemData['status'] = isset($itemData['status']) ? 1 : 0;

                    // Handle image upload for each item
                    if ($request->hasFile("items.{$index}.terms_conditions_iamage")) {
                        $image = $request->file("items.{$index}.terms_conditions_iamage");
                        $itemData['terms_conditions_iamage'] = $image->store('terms-conditions', 'public');
                    }

                    TermsConditions::create($itemData);
                    $createdCount++;
                } catch (\Exception $e) {
                    $errors[] = 'Item #'.($index + 1).' error: '.$e->getMessage();
                }
            }

            if ($createdCount > 0) {
                $message = $createdCount > 1
                    ? "{$createdCount} Terms & Conditions records created successfully."
                    : 'Terms & Conditions content created successfully.';

                if (! empty($errors)) {
                    $message .= ' But some items had errors: '.implode(', ', $errors);
                }

                return redirect()
                    ->route('admin.terms-conditions.index')
                    ->with('success', $message);
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to save Terms & Conditions.')
                    ->withInput();
            }
        } else {
            // Single item validation
            $validated = $request->validate([
                'terms_conditions_category' => 'nullable|string|max:255',
                'terms_conditions_title' => 'required|string|max:255',
                'terms_conditions_subtitle' => 'nullable|string|max:255',
                'terms_conditions_descripton' => 'required|string',
                'terms_conditions_iamage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status' => 'nullable|boolean',
            ]);

            $validated['status'] = $request->boolean('status');

            if ($request->hasFile('terms_conditions_iamage')) {
                $validated['terms_conditions_iamage'] = $request
                    ->file('terms_conditions_iamage')
                    ->store('terms-conditions', 'public');
            }

            TermsConditions::create($validated);

            return redirect()
                ->route('admin.terms-conditions.index')
                ->with('success', 'Terms & Conditions content created successfully.');
        }
    }

    public function edit(TermsConditions $termsConditions)
    {
        return view(
            'frontend.terms-conditions.edit',
            compact('termsConditions')
        );
    }

    public function update(Request $request, TermsConditions $termsConditions)
    {
        // Check if we have items array or single fields
        if ($request->has('items') && is_array($request->input('items')) && count($request->input('items')) > 0) {
            // Multiple items validation
            $validated = $request->validate([
                'items' => 'required|array|min:1',
                'items.*.terms_conditions_category' => 'nullable|string|max:255',
                'items.*.terms_conditions_title' => 'required|string|max:255',
                'items.*.terms_conditions_subtitle' => 'nullable|string|max:255',
                'items.*.terms_conditions_descripton' => 'required|string',
                'items.*.terms_conditions_iamage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'items.*.status' => 'nullable|boolean',
            ]);

            $updatedCount = 0;
            $errors = [];

            // Get all existing IDs
            $existingItems = TermsConditions::all();
            $existingIds = $existingItems->pluck('id')->toArray();

            // First, handle the first item (update existing)
            $firstItem = $request->input('items.0');
            if ($firstItem) {
                try {
                    // Set status
                    $firstItem['status'] = isset($firstItem['status']) ? 1 : 0;

                    // Handle image upload for first item
                    if ($request->hasFile('items.0.terms_conditions_iamage')) {
                        // Delete old image if exists
                        if ($termsConditions->terms_conditions_iamage) {
                            Storage::disk('public')->delete($termsConditions->terms_conditions_iamage);
                        }
                        $image = $request->file('items.0.terms_conditions_iamage');
                        $firstItem['terms_conditions_iamage'] = $image->store('terms-conditions', 'public');
                    }

                    $termsConditions->update($firstItem);
                    $updatedCount++;
                } catch (\Exception $e) {
                    $errors[] = 'Item #1 error: '.$e->getMessage();
                }
            }

            // Then handle additional items (create new)
            $itemsCount = count($request->input('items'));
            for ($i = 1; $i < $itemsCount; $i++) {
                try {
                    $itemData = $request->input("items.{$i}");
                    $itemData['status'] = isset($itemData['status']) ? 1 : 0;

                    // Handle image upload for each new item
                    if ($request->hasFile("items.{$i}.terms_conditions_iamage")) {
                        $image = $request->file("items.{$i}.terms_conditions_iamage");
                        $itemData['terms_conditions_iamage'] = $image->store('terms-conditions', 'public');
                    }

                    TermsConditions::create($itemData);
                    $updatedCount++;
                } catch (\Exception $e) {
                    $errors[] = 'Item #'.($i + 1).' error: '.$e->getMessage();
                }
            }

            // Delete items that were removed (if any)
            $submittedCount = count($request->input('items'));
            $existingCount = TermsConditions::count();

            if ($existingCount > $submittedCount) {
                // Get all current IDs after update
                $currentIds = TermsConditions::pluck('id')->toArray();
                // Keep the first ID (updated one)
                $keepIds = [$termsConditions->id];

                // Delete extra items
                $extraItems = TermsConditions::whereNotIn('id', $keepIds)->get();
                foreach ($extraItems as $extraItem) {
                    if ($extraItem->terms_conditions_iamage) {
                        Storage::disk('public')->delete($extraItem->terms_conditions_iamage);
                    }
                    $extraItem->delete();
                }
            }

            if ($updatedCount > 0) {
                $message = $updatedCount > 1
                    ? "{$updatedCount} Terms & Conditions records updated successfully."
                    : 'Terms & Conditions content updated successfully.';

                if (! empty($errors)) {
                    $message .= ' But some items had errors: '.implode(', ', $errors);
                }

                return redirect()
                    ->route('admin.terms-conditions.index')
                    ->with('success', $message);
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Failed to update Terms & Conditions.')
                    ->withInput();
            }
        } else {
            // Single item update (original logic)
            $validated = $request->validate([
                'terms_conditions_category' => 'nullable|string|max:255',
                'terms_conditions_title' => 'required|string|max:255',
                'terms_conditions_subtitle' => 'nullable|string|max:255',
                'terms_conditions_descripton' => 'required|string',
                'terms_conditions_iamage' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status' => 'nullable|boolean',
            ]);

            // Handle image upload
            if ($request->hasFile('terms_conditions_iamage')) {
                // Delete old image if exists
                if ($termsConditions->terms_conditions_iamage) {
                    Storage::disk('public')->delete($termsConditions->terms_conditions_iamage);
                }

                $validated['terms_conditions_iamage'] = $request
                    ->file('terms_conditions_iamage')
                    ->store('terms-conditions', 'public');
            }

            $validated['status'] = $request->boolean('status');

            $termsConditions->update($validated);

            return redirect()
                ->route('admin.terms-conditions.index')
                ->with('success', 'Terms & Conditions content updated successfully.');
        }
    }

    public function destroy(TermsConditions $termsConditions)
    {
        if ($termsConditions->terms_conditions_iamage) {
            Storage::disk('public')->delete(
                $termsConditions->terms_conditions_iamage
            );
        }

        $termsConditions->delete();

        return redirect()
            ->route('admin.terms-conditions.index')
            ->with(
                'success',
                'Terms & Conditions content deleted successfully.'
            );
    }
}
