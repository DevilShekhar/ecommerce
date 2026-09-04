<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Logo::first();

        return view('admin.logos.index', compact('logo'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:1024',
        ]);

        $logo = Logo::first();

        if (! $logo) {
            $logo = new Logo;
        }

        if ($request->hasFile('logo')) {

            if ($logo->logo && Storage::disk('public')->exists($logo->logo)) {
                Storage::disk('public')->delete($logo->logo);
            }

            $logo->logo = $request->file('logo')
                ->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {

            if ($logo->favicon && Storage::disk('public')->exists($logo->favicon)) {
                Storage::disk('public')->delete($logo->favicon);
            }

            $logo->favicon = $request->file('favicon')
                ->store('favicons', 'public');
        }

        $logo->save();

        return redirect()
            ->route('logos.index')
            ->with('success', 'Logo and favicon updated successfully.');

    }
}
