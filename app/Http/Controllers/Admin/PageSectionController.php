<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function index(Page $page)
    {
        $sections = $page->sections()
            ->orderBy('sort_order')
            ->get();

        return view(
            'admin.pages.sections.index',
            compact('page', 'sections')
        );
    }

    public function create(Page $page)
    {
        $products = Product::query()->where('status', 1)
            ->latest()
            ->get();

        return view(
            'admin.pages.sections.create',
            compact('page', 'products')
        );
    }

    public function store(Request $request, Page $page)
    {
        if ($page->sections()->where('section_type', $request->section_type)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'section_type' => 'This section already exists on this page. You can add it only once.',
                ]);
        }

        $validated = $request->validate([
            'section_type' => 'required|string',

            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',

            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',

            // Products
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',

            // Testimonials
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.designation' => 'nullable|string|max:255',
            'testimonials.*.content' => 'nullable|string',
            'testimonials.*.rating' => 'nullable|integer|min:1|max:5',
            'testimonials.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle Section Image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('page-sections', 'public');
        }

        $validated['page_id'] = $page->id;
        $validated['status'] = $request->has('status') ? 1 : 0;
        if ($request->section_type === 'testimonials' && $request->has('testimonials')) {
            $testimonials = [];

            foreach ($request->testimonials as $index => $testimonial) {
                $testimonialData = [
                    'name' => $testimonial['name'] ?? '',
                    'designation' => $testimonial['designation'] ?? '',
                    'content' => $testimonial['content'] ?? '',
                    'rating' => $testimonial['rating'] ?? 0,
                    'image' => null,
                ];

                // Handle testimonial image
                if ($request->hasFile("testimonials.{$index}.image")) {
                    $imagePath = $request->file("testimonials.{$index}.image")
                        ->store('testimonials', 'public');
                    $testimonialData['image'] = $imagePath;
                }

                $testimonials[] = $testimonialData;
            }

            $validated['testimonials'] = json_encode($testimonials);
        }
        if ($request->section_type === 'services' && $request->has('services')) {
            $services = [];

            foreach ($request->services as $service) {
                $services[] = [
                    'title' => $service['title'] ?? '',
                    'description' => $service['description'] ?? '',
                    'icon' => $service['icon'] ?? 'bi bi-star',
                ];
            }

            $validated['services'] = json_encode($services);
        }
        if ($request->section_type === 'features' && $request->has('features')) {
            $features = [];

            foreach ($request->features as $feature) {
                $features[] = [
                    'title' => $feature['title'] ?? '',
                    'description' => $feature['description'] ?? '',
                    'icon' => $feature['icon'] ?? 'bi bi-check-circle',
                ];
            }

            $validated['features'] = json_encode($features);
        }

        // Create Section
        $section = PageSection::create($validated);

        // Save selected products
        if ($request->section_type === 'products' && $request->filled('products')) {
            $section->products()->sync($request->products);
        }

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section created successfully.');
    }

    public function edit(Page $page, PageSection $section)
    {
        $products = Product::query()->where('status', 1)
            ->latest()
            ->get();

        $selectedProducts = $section->products()
            ->pluck('products.id')
            ->toArray();

        // Decode testimonials if present
        $testimonials = [];
        if ($section->section_type === 'testimonials' && $section->testimonials) {
            $testimonials = json_decode($section->testimonials, true) ?? [];
        }

        // Decode services if present
        $services = [];
        if ($section->section_type === 'services' && $section->services) {
            $services = json_decode($section->services, true) ?? [];
        }

        // Decode features if present
        $features = [];
        if ($section->section_type === 'features' && $section->features) {
            $features = json_decode($section->features, true) ?? [];
        }

        return view(
            'admin.pages.sections.edit',
            compact(
                'page',
                'section',
                'products',
                'selectedProducts',
                'testimonials',
                'services',
                'features'
            )
        );
    }

    public function update(
        Request $request,
        Page $page,
        PageSection $section
    ) {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',

            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',

            // Products
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ]);
        if ($request->hasFile('image')) {
            if (
                $section->image &&
                Storage::disk('public')->exists($section->image)
            ) {
                Storage::disk('public')->delete($section->image);
            }

            $validated['image'] = $request->file('image')
                ->store('page-sections', 'public');
        }

        $validated['status'] = $request->has('status') ? 1 : 0;

        if ($request->section_type === 'testimonials' && $request->has('testimonials')) {
            $testimonials = [];

            foreach ($request->testimonials as $index => $testimonial) {
                $testimonialData = [
                    'name' => $testimonial['name'] ?? '',
                    'designation' => $testimonial['designation'] ?? '',
                    'content' => $testimonial['content'] ?? '',
                    'rating' => $testimonial['rating'] ?? 0,
                    'image' => null,
                ];

                // Check if there's an existing image
                $existingTestimonials = json_decode($section->testimonials, true) ?? [];
                if (isset($existingTestimonials[$index]['image']) && $existingTestimonials[$index]['image']) {
                    $testimonialData['image'] = $existingTestimonials[$index]['image'];
                }

                // Handle new testimonial image upload
                if ($request->hasFile("testimonials.{$index}.image")) {
                    // Delete old image if exists
                    if ($testimonialData['image'] && Storage::disk('public')->exists($testimonialData['image'])) {
                        Storage::disk('public')->delete($testimonialData['image']);
                    }

                    $imagePath = $request->file("testimonials.{$index}.image")
                        ->store('testimonials', 'public');
                    $testimonialData['image'] = $imagePath;
                }

                $testimonials[] = $testimonialData;
            }

            $validated['testimonials'] = json_encode($testimonials);
        } else {
            $validated['testimonials'] = null;
        }
        if ($request->section_type === 'services' && $request->has('services')) {
            $services = [];

            foreach ($request->services as $service) {
                $services[] = [
                    'title' => $service['title'] ?? '',
                    'description' => $service['description'] ?? '',
                    'icon' => $service['icon'] ?? 'bi bi-star',
                ];
            }

            $validated['services'] = json_encode($services);
        } else {
            $validated['services'] = null;
        }
        if ($request->section_type === 'features' && $request->has('features')) {
            $features = [];

            foreach ($request->features as $feature) {
                $features[] = [
                    'title' => $feature['title'] ?? '',
                    'description' => $feature['description'] ?? '',
                    'icon' => $feature['icon'] ?? 'bi bi-check-circle',
                ];
            }

            $validated['features'] = json_encode($features);
        } else {
            $validated['features'] = null;
        }
        $section->update($validated);
        if ($section->section_type === 'products') {
            $products = $request->input('products', []);
            $syncData = [];

            foreach ($products as $index => $productId) {
                $syncData[$productId] = [
                    'sort_order' => $index + 1,
                ];
            }

            $section->products()->sync($syncData);
        } else {
            $section->products()->detach();
        }

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Page $page, PageSection $section)
    {
        if ($section->section_type === 'testimonials' && $section->testimonials) {
            $testimonials = json_decode($section->testimonials, true) ?? [];
            foreach ($testimonials as $testimonial) {
                if (!empty($testimonial['image']) && Storage::disk('public')->exists($testimonial['image'])) {
                    Storage::disk('public')->delete($testimonial['image']);
                }
            }
        }
        if ($section->image && Storage::disk('public')->exists($section->image)) {
            Storage::disk('public')->delete($section->image);
        }
        $section->products()->detach();
        $section->update([
            'status' => 0,
        ]);

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section deleted successfully.');
    }
}
