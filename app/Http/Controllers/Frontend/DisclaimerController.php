<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Disclaimer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisclaimerController extends Controller
{
   public function index()
{
    $disclaimer = Disclaimer::where('status', 1)->first();

    return view(
        'frontend.disclaimers.index',
        compact('disclaimer')
    );
}

    public function adminIndex()
    {
        $disclaimers = Disclaimer::latest()->get();

        return view(
            'frontend.disclaimers.admin-index',
            compact('disclaimers')
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('frontend.disclaimers.create');
    }

    /**
     * Store disclaimer.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subtitle' => 'nullable|string|max:255',

            'title' => 'required|string|max:255',

            'description' => 'required|string',

            'section_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => 'nullable|boolean',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Section Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('section_image')) {

            $image = $request->file('section_image');

            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/disclaimer'),
                $imageName
            );

            $validatedData['section_image'] =
                'uploads/disclaimer/'.$imageName;
        }

        $validatedData['created_by'] = Auth::id();

        $validatedData['status'] = $request->has('status')
            ? $request->status
            : 1;

        Disclaimer::create($validatedData);

        return redirect()
            ->route('admin.disclaimers.index')
            ->with('success', 'Disclaimer created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $disclaimer = Disclaimer::findOrFail($id);

        return view(
            'frontend.disclaimers.edit',
            compact('disclaimer')
        );
    }

    /**
     * Update disclaimer.
     */
    public function update(Request $request, $id)
    {
        $disclaimer = Disclaimer::findOrFail($id);

        $validatedData = $request->validate([
            'subtitle' => 'nullable|string|max:255',

            'title' => 'required|string|max:255',

            'description' => 'required|string',

            'section_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => 'nullable|boolean',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload New Section Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('section_image')) {

            /*
            | Delete old image
            */

            if (
                $disclaimer->section_image &&
                file_exists(public_path($disclaimer->section_image))
            ) {
                unlink(
                    public_path($disclaimer->section_image)
                );
            }

            $image = $request->file('section_image');

            $imageName =
                time().'_'.
                uniqid().'.'.
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/disclaimer'),
                $imageName
            );

            $validatedData['section_image'] =
                'uploads/disclaimer/'.$imageName;
        }

        $validatedData['updated_by'] = Auth::id();

        $validatedData['status'] = $request->has('status')
            ? $request->status
            : 0;

        $disclaimer->update($validatedData);

        return redirect()
            ->route('admin.disclaimers.index')
            ->with('success', 'Disclaimer updated successfully.');
    }

    /**
     * Delete disclaimer.
     */
    public function destroy($id)
    {
        $disclaimer = Disclaimer::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Delete Image
        |--------------------------------------------------------------------------
        */

        if (
            $disclaimer->section_image &&
            file_exists(public_path($disclaimer->section_image))
        ) {
            unlink(
                public_path($disclaimer->section_image)
            );
        }

        $disclaimer->delete();

        return redirect()
            ->route('admin.disclaimers.index')
            ->with('success', 'Disclaimer deleted successfully.');
    }

    /**
     * Toggle status.
     */
    public function toggleStatus($id)
    {
        $disclaimer = Disclaimer::findOrFail($id);

        $disclaimer->status =
            ! $disclaimer->status;

        $disclaimer->updated_by = Auth::id();

        $disclaimer->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'Disclaimer status updated successfully.'
            );
    }
}
