<?php

namespace App\Http\Controllers\Super;

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
        if ($page->sections()
            ->where('section_type', $request->section_type)
            ->exists()) {

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
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.designation' => 'nullable|string|max:255',
            'testimonials.*.content' => 'nullable|string',
            'testimonials.*.rating' => 'nullable|integer|min:1|max:5',
            'testimonials.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string|max:500',
            'faqs.*.answer' => 'nullable|string',
            'form_fields' => 'nullable|array',
            'form_fields.*.label' => 'nullable|string|max:255',
            'form_fields.*.type' => 'nullable|string|in:text,email,textarea,select,checkbox,radio,number,phone,file',
            'form_fields.*.name' => 'nullable|string|max:255',
            'form_fields.*.placeholder' => 'nullable|string|max:255',
            'form_fields.*.required' => 'nullable|boolean',
            'form_fields.*.options' => 'nullable',
            'form_fields.*.options.*' => 'nullable|string',
            'form_action' => 'nullable|string|max:255',
            'form_method' => 'nullable|string|in:POST,GET',
            'addresses' => 'nullable|array',
            'addresses.*.address' => 'nullable|string|max:500',
            'addresses.*.city' => 'nullable|string|max:255',
            'addresses.*.state' => 'nullable|string|max:255',
            'addresses.*.zip' => 'nullable|string|max:20',
            'addresses.*.country' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'hero_images' => 'nullable|array',
            'hero_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'privacy_content' => 'nullable|string',
            'terms_content' => 'nullable|string',
            'policy_content' => 'nullable|string',
            'policy_sections' => 'nullable|array',
            'policy_sections.*.title' => 'nullable|string|max:255',
            'policy_sections.*.content' => 'nullable|string',
            'disclaimer_title' => 'nullable|string|max:255',
            'disclaimer_description' => 'nullable|string',
        ]);

        $validated['page_id'] = $page->id;
        $validated['status'] = $request->has('status') ? 1 : 0;

        // =============================================
        // Handle Section Image
        // =============================================
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('page-sections', 'public');
        }

        unset($validated['products']);

        // =============================================
        // Handle Hero Multiple Images
        // =============================================
        if ($request->section_type === 'hero' && $request->hasFile('hero_images')) {
            $images = [];
            foreach ($request->file('hero_images') as $image) {
                if ($image->isValid()) {
                    $path = $image->store('hero-images', 'public');
                    $images[] = $path;
                }
            }
            $validated['images'] = json_encode($images);
        }

        // =============================================
        // Handle Testimonials
        // =============================================
        if ($request->section_type === 'testimonials' && $request->has('testimonials')) {
            $testimonials = [];

            foreach ($request->input('testimonials', []) as $index => $testimonial) {
                $testimonialData = [
                    'name' => $testimonial['name'] ?? '',
                    'designation' => $testimonial['designation'] ?? '',
                    'content' => $testimonial['content'] ?? '',
                    'rating' => $testimonial['rating'] ?? 0,
                    'image' => null,
                ];

                if ($request->hasFile("testimonials.{$index}.image")) {
                    $imagePath = $request
                        ->file("testimonials.{$index}.image")
                        ->store('testimonials', 'public');

                    $testimonialData['image'] = $imagePath;
                }

                $testimonials[] = $testimonialData;
            }

            $validated['testimonials'] = json_encode($testimonials);
        } else {
            $validated['testimonials'] = null;
        }
        if ($request->section_type === 'disclaimer') {
            $validated['disclaimer_title'] = $request->disclaimer_title;
            $validated['disclaimer_description'] = $request->disclaimer_description;
        } else {
            $validated['disclaimer_title'] = null;
            $validated['disclaimer_description'] = null;
        }

        // =============================================
        // Handle Contact Form
        // =============================================
        if ($request->section_type === 'contact') {
            $formFields = [];

            foreach ($request->input('form_fields', []) as $field) {
                $options = $field['options'] ?? [];

                if (is_string($options)) {
                    $options = array_values(
                        array_filter(
                            array_map('trim', explode(',', $options))
                        )
                    );
                }

                $formFields[] = [
                    'label' => $field['label'] ?? '',
                    'type' => $field['type'] ?? 'text',
                    'name' => $field['name'] ?? '',
                    'placeholder' => $field['placeholder'] ?? '',
                    'required' => isset($field['required']) ? 1 : 0,
                    'options' => $options,
                ];
            }

            $validated['form_fields'] = json_encode($formFields);
            $validated['form_action'] = $request->input('form_action') ?: '/contact/submit';
            $validated['form_method'] = $request->input('form_method') ?: 'POST';
        } else {
            $validated['form_fields'] = null;
            $validated['form_action'] = '';
            $validated['form_method'] = 'POST';
        }

        // =============================================
        // Handle Services
        // =============================================
        if ($request->section_type === 'services' && $request->has('services')) {
            $services = [];

            foreach ($request->input('services', []) as $service) {
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

        // =============================================
        // Handle Features
        // =============================================
        if ($request->section_type === 'features' && $request->has('features')) {
            $features = [];

            foreach ($request->input('features', []) as $feature) {
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

        // =============================================
        // Handle FAQ
        // =============================================
        if ($request->section_type === 'faq' && $request->has('faqs')) {
            $faqs = [];

            foreach ($request->input('faqs', []) as $faq) {
                if (empty($faq['question']) && empty($faq['answer'])) {
                    continue;
                }

                $faqs[] = [
                    'question' => $faq['question'] ?? '',
                    'answer' => $faq['answer'] ?? '',
                ];
            }

            $validated['faqs'] = ! empty($faqs)
                ? json_encode($faqs)
                : null;
        } else {
            $validated['faqs'] = null;
        }

        // =============================================
        // Handle Footer
        // =============================================
        if ($request->section_type === 'footer') {
            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')
                    ->store('footer-logos', 'public');
            }

            $addresses = [];

            foreach ($request->input('addresses', []) as $address) {
                if (
                    ! empty($address['address']) ||
                    ! empty($address['city']) ||
                    ! empty($address['state']) ||
                    ! empty($address['zip']) ||
                    ! empty($address['country'])
                ) {
                    $addresses[] = [
                        'address' => $address['address'] ?? '',
                        'city' => $address['city'] ?? '',
                        'state' => $address['state'] ?? '',
                        'zip' => $address['zip'] ?? '',
                        'country' => $address['country'] ?? '',
                    ];
                }
            }

            $validated['addresses'] = ! empty($addresses)
                ? json_encode($addresses)
                : null;
        } else {
            $validated['addresses'] = null;
            $validated['logo'] = null;
        }

        // =============================================
        // Handle Privacy & Policy
        // =============================================
        if ($request->section_type === 'privacy_policy') {
            $validated['privacy_content'] = $request->privacy_content;
            $validated['terms_content'] = $request->terms_content;
            $validated['policy_content'] = $request->policy_content;

            if ($request->has('policy_sections')) {
                $policySections = [];
                foreach ($request->policy_sections as $sectionItem) {
                    if (! empty($sectionItem['title']) || ! empty($sectionItem['content'])) {
                        $policySections[] = [
                            'title' => $sectionItem['title'] ?? '',
                            'content' => $sectionItem['content'] ?? '',
                        ];
                    }
                }
                $validated['policy_sections'] = ! empty($policySections)
                    ? json_encode($policySections)
                    : null;
            } else {
                $validated['policy_sections'] = null;
            }
        } else {
            $validated['privacy_content'] = null;
            $validated['terms_content'] = null;
            $validated['policy_content'] = null;
            $validated['policy_sections'] = null;
        }

        // =============================================
        // Create Section
        // =============================================
        $section = PageSection::create($validated);

        // =============================================
        // Attach Products
        // =============================================
        if (
            $request->section_type === 'products' &&
            $request->filled('products')
        ) {
            $section->products()->sync($request->products);
        }

        return redirect()
            ->route('admin.pages.sections.index', $page)
            ->with('success', 'Section created successfully.');
    }

    public function edit(Page $page, PageSection $section)
    {
        $products = Product::query()
            ->where('status', 1)
            ->latest()
            ->get();

        $selectedProducts = $section->products()
            ->pluck('products.id')
            ->toArray();

        $testimonials = [];
        if ($section->section_type === 'testimonials' && $section->testimonials) {
            $testimonials = json_decode($section->testimonials, true) ?? [];
        }

        $faqs = [];
        if ($section->section_type === 'faq' && $section->faqs) {
            $faqs = json_decode($section->faqs, true) ?? [];
        }

        $services = [];
        if ($section->section_type === 'services' && $section->services) {
            $services = json_decode($section->services, true) ?? [];
        }

        $features = [];
        if ($section->section_type === 'features' && $section->features) {
            $features = json_decode($section->features, true) ?? [];
        }

        $addresses = [];
        if ($section->section_type === 'footer' && $section->addresses) {
            $addresses = json_decode($section->addresses, true) ?? [];
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
                'features',
                'faqs',
                'addresses'
            )
        );
    }

    public function update(Request $request, Page $page, PageSection $section)
    {
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
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.designation' => 'nullable|string|max:255',
            'testimonials.*.content' => 'nullable|string',
            'testimonials.*.rating' => 'nullable|integer|min:1|max:5',
            'testimonials.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string|max:500',
            'faqs.*.answer' => 'nullable|string',
            'form_fields' => 'nullable|array',
            'form_fields.*.label' => 'nullable|string|max:255',
            'form_fields.*.type' => 'nullable|string|in:text,email,textarea,select,checkbox,radio,number,phone,file',
            'form_fields.*.name' => 'nullable|string|max:255',
            'form_fields.*.placeholder' => 'nullable|string|max:255',
            'form_fields.*.required' => 'nullable|boolean',
            'form_fields.*.options' => 'nullable|array',
            'form_fields.*.options.*' => 'nullable|string',
            'form_action' => 'nullable|string|max:255',
            'form_method' => 'nullable|string|in:POST,GET',
            'addresses' => 'nullable|array',
            'addresses.*.address' => 'nullable|string|max:500',
            'addresses.*.city' => 'nullable|string|max:255',
            'addresses.*.state' => 'nullable|string|max:255',
            'addresses.*.zip' => 'nullable|string|max:20',
            'addresses.*.country' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            // Hero Multiple Images
            'hero_images' => 'nullable|array',
            'hero_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            // Privacy & Policy
            'privacy_content' => 'nullable|string',
            'terms_content' => 'nullable|string',
            'policy_content' => 'nullable|string',
            'policy_sections' => 'nullable|array',
            'policy_sections.*.title' => 'nullable|string|max:255',
            'policy_sections.*.content' => 'nullable|string',
            'disclaimer_title' => 'nullable|string|max:255',
            'disclaimer_description' => 'nullable|string',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

        // =============================================
        // Handle Section Image
        // =============================================
        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('page-sections', 'public');
        }

        // =============================================
        // Handle Hero Multiple Images
        // =============================================
        if ($request->section_type === 'hero') {
            $existingImages = $section->images ? json_decode($section->images, true) : [];
            $newImages = [];

            if ($request->hasFile('hero_images')) {
                foreach ($existingImages as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
                foreach ($request->file('hero_images') as $image) {
                    if ($image && $image->isValid()) {
                        $path = $image->store('hero-images', 'public');
                        $newImages[] = $path;
                    }
                }
                $validated['images'] = json_encode($newImages);
            } else {
                $validated['images'] = $section->images;
            }
        } else {
            if ($section->images) {
                $oldImages = json_decode($section->images, true) ?? [];
                foreach ($oldImages as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            $validated['images'] = null;
        }

        // =============================================
        // Handle Testimonials
        // =============================================
        if ($request->section_type === 'testimonials' && $request->has('testimonials')) {
            $testimonials = [];
            $existingTestimonials = json_decode($section->testimonials, true) ?? [];

            foreach ($request->testimonials as $index => $testimonial) {
                $testimonialData = [
                    'name' => $testimonial['name'] ?? '',
                    'designation' => $testimonial['designation'] ?? '',
                    'content' => $testimonial['content'] ?? '',
                    'rating' => $testimonial['rating'] ?? 0,
                    'image' => $existingTestimonials[$index]['image'] ?? null,
                ];

                if ($request->hasFile("testimonials.{$index}.image")) {
                    if ($testimonialData['image'] && Storage::disk('public')->exists($testimonialData['image'])) {
                        Storage::disk('public')->delete($testimonialData['image']);
                    }
                    $testimonialData['image'] = $request->file("testimonials.{$index}.image")->store('testimonials', 'public');
                }

                $testimonials[] = $testimonialData;
            }

            $validated['testimonials'] = json_encode($testimonials);
        } else {
            $validated['testimonials'] = null;
        }

        if ($request->section_type === 'disclaimer') {
            $validated['disclaimer_title'] = $request->disclaimer_title;
            $validated['disclaimer_description'] = $request->disclaimer_description;
        } else {
            $validated['disclaimer_title'] = null;
            $validated['disclaimer_description'] = null;
        }

        // =============================================
        // Handle FAQ
        // =============================================
        if ($request->section_type === 'faq' && $request->has('faqs')) {
            $faqs = [];
            foreach ($request->faqs as $faq) {
                if (! empty($faq['question']) || ! empty($faq['answer'])) {
                    $faqs[] = [
                        'question' => $faq['question'] ?? '',
                        'answer' => $faq['answer'] ?? '',
                    ];
                }
            }
            $validated['faqs'] = ! empty($faqs) ? json_encode($faqs) : null;
        } else {
            $validated['faqs'] = null;
        }

        // =============================================
        // Handle Contact Form
        // =============================================
        if ($request->section_type === 'contact') {
            $formFields = [];
            foreach ($request->input('form_fields', []) as $field) {
                $formFields[] = [
                    'label' => $field['label'] ?? '',
                    'type' => $field['type'] ?? 'text',
                    'name' => $field['name'] ?? '',
                    'placeholder' => $field['placeholder'] ?? '',
                    'required' => isset($field['required']) ? 1 : 0,
                    'options' => $field['options'] ?? [],
                ];
            }
            $validated['form_fields'] = json_encode($formFields);
            $validated['form_action'] = $request->form_action ?: '/contact/submit';
            $validated['form_method'] = $request->form_method ?: 'POST';
        } else {
            $validated['form_fields'] = $section->form_fields;
            $validated['form_action'] = $section->form_action ?: '';
            $validated['form_method'] = $section->form_method ?: 'POST';
        }

        // =============================================
        // Handle Services
        // =============================================
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

        // =============================================
        // Handle Features
        // =============================================
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

        // =============================================
        // Handle Footer
        // =============================================
        if ($request->section_type === 'footer') {
            if ($request->hasFile('logo')) {
                if ($section->logo && Storage::disk('public')->exists($section->logo)) {
                    Storage::disk('public')->delete($section->logo);
                }
                $validated['logo'] = $request->file('logo')->store('footer-logos', 'public');
            } else {
                $validated['logo'] = $section->logo;
            }

            $addresses = [];
            foreach ($request->input('addresses', []) as $address) {
                if (! empty($address['address']) || ! empty($address['city']) || ! empty($address['state']) || ! empty($address['zip']) || ! empty($address['country'])) {
                    $addresses[] = [
                        'address' => $address['address'] ?? '',
                        'city' => $address['city'] ?? '',
                        'state' => $address['state'] ?? '',
                        'zip' => $address['zip'] ?? '',
                        'country' => $address['country'] ?? '',
                    ];
                }
            }
            $validated['addresses'] = json_encode($addresses);
        } else {
            $validated['logo'] = $section->logo;
            $validated['addresses'] = $section->addresses;
        }

        // =============================================
        // Handle Privacy & Policy
        // =============================================
        if ($request->section_type === 'privacy_policy') {
            $validated['privacy_content'] = $request->privacy_content;
            $validated['terms_content'] = $request->terms_content;
            $validated['policy_content'] = $request->policy_content;

            // Handle Policy Sections
            if ($request->has('policy_sections')) {
                $policySections = [];
                foreach ($request->policy_sections as $sectionItem) {
                    if (! empty($sectionItem['title']) || ! empty($sectionItem['content'])) {
                        $policySections[] = [
                            'title' => $sectionItem['title'] ?? '',
                            'content' => $sectionItem['content'] ?? '',
                        ];
                    }
                }
                $validated['policy_sections'] = ! empty($policySections) ? json_encode($policySections) : null;
            } else {
                $validated['policy_sections'] = null;
            }
        } else {
            // If section type is not privacy_policy, clear the fields
            $validated['privacy_content'] = null;
            $validated['terms_content'] = null;
            $validated['policy_content'] = null;
            $validated['policy_sections'] = null;
        }

        // =============================================
        // Update Section
        // =============================================
        unset($validated['products']);
        $section->update($validated);

        // =============================================
        // Update Products
        // =============================================
        if ($request->section_type === 'products') {
            $products = $request->input('products', []);
            $syncData = [];
            foreach ($products as $index => $productId) {
                $syncData[$productId] = ['sort_order' => $index + 1];
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
                if (! empty($testimonial['image']) && Storage::disk('public')->exists($testimonial['image'])) {
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
