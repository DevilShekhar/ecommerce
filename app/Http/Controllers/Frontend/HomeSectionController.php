<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSectionController extends Controller
{
    /**
     * Public Home Page
     */
    public function index()
    {
        $homeSections = HomeSection::where('status', 1)
            ->latest()
            ->get();
        return view('frontend.home.index', compact(
            'homeSections'
        ));
    }
    /**
     * Admin Home Sections
     */
    public function adminIndex()
    {
        $homeSections = HomeSection::latest()->get();
        return view(
            'frontend.home.admin-index',
            compact('homeSections')
        );
    }

    /**
     * Create Home Section
     */
    public function create()
    {
        return view('frontend.home.create');
    }

    /**
     * Store Home Section
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        /**
         * Upload Image
         */
        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('home-sections', 'public');
        }
        $validated['status'] = $request->boolean('status');
        HomeSection::create($validated);
        return redirect()
            ->route('admin.sections.index')
            ->with(
                'success',
                'Home section created successfully.'
            );
    }

    /**
     * Edit Home Section
     */
    public function edit(HomeSection $homeSection)
    {
        return view(
            'frontend.home.edit',
            compact('homeSection')
        );
    }

    /**
     * Update Home Section
     */
    public function update(
        Request $request,
        HomeSection $homeSection
    ) {
        $validated = $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);
        /**
         * Replace Image
         */
        if ($request->hasFile('image')) {

            if ($homeSection->image) {
                Storage::disk('public')
                    ->delete($homeSection->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('home-sections', 'public');
        }
        $validated['status'] = $request->boolean('status');
        $homeSection->update($validated);
        return redirect()
            ->route('admin.sections.index')
            ->with(
                'success',
                'Home section updated successfully.'
            );
    }

    /**
     * Delete Home Section
     */
    public function destroy(HomeSection $homeSection)
    {
        if ($homeSection->image) {
            Storage::disk('public')
                ->delete($homeSection->image);
        }
        $homeSection->delete();
        return redirect()
            ->route('admin.sections.index')
            ->with(
                'success',
                'Home section deleted successfully.'
            );
    }
}
