<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $privacyPolicies = PrivacyPolicy::where('status', 1)
            ->latest()
            ->get();

        return view(
            'frontend.privacy-policy.index',
            compact('privacyPolicies')
        );
    }

    public function adminIndex()
    {
        $privacyPolicies = PrivacyPolicy::latest()->get();

        return view(
            'frontend.privacy-policy.admin-index',
            compact('privacyPolicies')
        );
    }

    public function create()
    {
        return view('frontend.privacy-policy.create');
    }

    public function store(Request $request)
    {
        if (
            $request->has('items') &&
            is_array($request->input('items')) &&
            count($request->input('items')) > 0
        ) {
            $request->validate([
                'items' => 'required|array|min:1',
                'items.*.privacy_policy_title' => 'required|string|max:255',
                'items.*.privacy_policy_subtitle' => 'nullable|string|max:255',
                'items.*.privacy_policy_description' => 'required|string',
                'items.*.privacy_policy_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'items.*.status' => 'nullable|boolean',
            ]);

            $createdCount = 0;
            $errors = [];

            foreach ($request->input('items') as $index => $itemData) {
                try {
                    $itemData['status'] = isset($itemData['status']) ? 1 : 0;

                    if ($request->hasFile("items.{$index}.privacy_policy_image")) {
                        $image = $request->file("items.{$index}.privacy_policy_image");

                        $itemData['privacy_policy_image'] = $image->store(
                            'privacy-policy',
                            'public'
                        );
                    }

                    PrivacyPolicy::create($itemData);

                    $createdCount++;
                } catch (\Exception $e) {
                    $errors[] = 'Item #'.($index + 1).' error: '.$e->getMessage();
                }
            }

            if ($createdCount > 0) {
                $message = $createdCount > 1
                    ? "{$createdCount} Privacy Policy records created successfully."
                    : 'Privacy Policy content created successfully.';

                if (! empty($errors)) {
                    $message .= ' But some items had errors: '.implode(', ', $errors);
                }

                return redirect()
                    ->route('admin.privacy-policies.index')
                    ->with('success', $message);
            }

            return redirect()
                ->back()
                ->with('error', 'Failed to save Privacy Policy.')
                ->withInput();
        }

        $validated = $request->validate([
            'privacy_policy_title' => 'required|string|max:255',
            'privacy_policy_subtitle' => 'nullable|string|max:255',
            'privacy_policy_description' => 'required|string',
            'privacy_policy_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('privacy_policy_image')) {
            $validated['privacy_policy_image'] = $request
                ->file('privacy_policy_image')
                ->store('privacy-policy', 'public');
        }

        PrivacyPolicy::create($validated);

        return redirect()
            ->route('admin.privacy-policies.index')
            ->with('success', 'Privacy Policy content created successfully.');
    }

    public function edit(PrivacyPolicy $privacyPolicy)
    {
        return view(
            'frontend.privacy-policy.edit',
            compact('privacyPolicy')
        );
    }

    public function update(Request $request, PrivacyPolicy $privacyPolicy)
    {
        $validated = $request->validate([
            'privacy_policy_title' => 'required|string|max:255',
            'privacy_policy_subtitle' => 'nullable|string|max:255',
            'privacy_policy_description' => 'required|string',
            'privacy_policy_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('privacy_policy_image')) {
            if ($privacyPolicy->privacy_policy_image) {
                Storage::disk('public')->delete(
                    $privacyPolicy->privacy_policy_image
                );
            }

            $validated['privacy_policy_image'] = $request
                ->file('privacy_policy_image')
                ->store('privacy-policy', 'public');
        }

        $privacyPolicy->update($validated);

        return redirect()
            ->route('admin.privacy-policies.index')
            ->with('success', 'Privacy Policy content updated successfully.');
    }

    public function destroy(PrivacyPolicy $privacyPolicy)
    {
        if ($privacyPolicy->privacy_policy_image) {
            Storage::disk('public')->delete(
                $privacyPolicy->privacy_policy_image
            );
        }

        $privacyPolicy->delete();

        return redirect()
            ->route('admin.privacy-policies.index')
            ->with(
                'success',
                'Privacy Policy content deleted successfully.'
            );
    }
}
