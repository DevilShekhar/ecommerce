<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::query()->where('slug', '/')
            ->where('status', true)
            ->with([
                'sections' => function ($query) {
                    $query->where('status', true)
                        ->orderBy('sort_order');
                },
            ])
            ->firstOrFail();

        // Fetch all active banners
        $banners = Banner::query()->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.page', compact('page', 'banners'));
    }

    public function show($slug)
    {
        $page = Page::query()->where('slug', $slug)
            ->where('status', 1)
            ->with([
                'sections' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('sort_order');
                },
                'sections.products',
            ])
            ->firstOrFail();

        // Fetch all active banners
        $banners = Banner::query()->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        // Collect all images from the sections (adjust the field name)
        $images = $page->sections->pluck('image')->filter();

        return view('frontend.page', compact('page', 'images', 'banners'));
    }
}
