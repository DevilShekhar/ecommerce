<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{

    public function index()
    {
        $aboutUs = AboutUs::where('status', 1)->first();

        $categories = ProductCategory::where('status', 1)->get();

        return view('frontend.about-us.index', compact(
            'aboutUs',
            'categories'
        ));
    }

    public function adminIndex()
    {
        $aboutUs = AboutUs::latest()->get();

        return view('frontend.about-us.admin-index', compact('aboutUs'));
    }

    public function create()
    {
        // Only one About Us record allowed
        if (AboutUs::exists()) {
            return redirect()
                ->route('admin.about-us.edit', AboutUs::first()->id);
        }

        return view('frontend.about-us.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            // ABOUT
            'about_sub_title' => 'nullable|string|max:255',
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // MISSION
            'mission_sub_title' => 'nullable|string|max:255',
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',
            'mission_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // VISION
            'vision_sub_title' => 'nullable|string|max:255',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('about_image')) {
            $validated['about_image'] = $request
                ->file('about_image')
                ->store('about-us', 'public');
        }

        if ($request->hasFile('mission_image')) {
            $validated['mission_image'] = $request
                ->file('mission_image')
                ->store('about-us', 'public');
        }

        if ($request->hasFile('vision_image')) {
            $validated['vision_image'] = $request
                ->file('vision_image')
                ->store('about-us', 'public');
        }

        $validated['status'] = $request->boolean('status');

        AboutUs::create($validated);


        return redirect()
            ->route('admin.about-us.index')
            ->with('success', 'About Us content created successfully.');
    }

    public function edit(AboutUs $aboutUs)
    {
        return view('frontend.about-us.edit', compact('aboutUs'));
    }

    public function update(Request $request, AboutUs $aboutUs)
    {
        $validated = $request->validate([

            // ABOUT
            'about_sub_title' => 'nullable|string|max:255',
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // MISSION
            'mission_sub_title' => 'nullable|string|max:255',
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',
            'mission_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // VISION
            'vision_sub_title' => 'nullable|string|max:255',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('about_image')) {

            if ($aboutUs->about_image) {
                Storage::disk('public')->delete($aboutUs->about_image);
            }

            $validated['about_image'] = $request
                ->file('about_image')
                ->store('about-us', 'public');
        }
        if ($request->hasFile('mission_image')) {

            if ($aboutUs->mission_image) {
                Storage::disk('public')->delete($aboutUs->mission_image);
            }

            $validated['mission_image'] = $request
                ->file('mission_image')
                ->store('about-us', 'public');
        }

        if ($request->hasFile('vision_image')) {

            if ($aboutUs->vision_image) {
                Storage::disk('public')->delete($aboutUs->vision_image);
            }

            $validated['vision_image'] = $request
                ->file('vision_image')
                ->store('about-us', 'public');
        }

        $validated['status'] = $request->boolean('status');

        $aboutUs->update($validated);


        return redirect()
            ->route('admin.about-us.index')
            ->with('success', 'About Us content updated successfully.');
    }

    public function destroy(AboutUs $aboutUs)
    {

        if ($aboutUs->about_image) {
            Storage::disk('public')->delete($aboutUs->about_image);
        }
        if ($aboutUs->mission_image) {
            Storage::disk('public')->delete($aboutUs->mission_image);
        }

        if ($aboutUs->vision_image) {
            Storage::disk('public')->delete($aboutUs->vision_image);
        }

        $aboutUs->delete();


        return redirect()
            ->route('admin.about-us.index')
            ->with('success', 'About Us content deleted successfully.');
    }
}
