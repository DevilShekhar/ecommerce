<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;
use App\Models\ProductCategory;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::query()
            ->where('slug', '/')
            ->where('status', true)
            ->with([
                'sections' => function ($query) {
                    $query->where('status', true)
                        ->orderBy('sort_order');
                },
            ])
            ->firstOrFail();

        // Fetch all active banners
        $banners = Banner::query()
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        // Fetch ALL active categories
        $categories = ProductCategory::query()
            ->where('status', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', 1);
                }
            ])
            ->orderBy('name', 'asc')
            ->get();

        return view('frontend.page', compact(
            'page',
            'banners',
            'categories'
        ));
    }

    public function show($slug)
    {
        $page = Page::query()
            ->where('slug', $slug)
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
        $banners = Banner::query()
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        // Fetch ALL active categories
        $categories = ProductCategory::query()
            ->where('status', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', 1);
                }
            ])
            ->orderBy('name', 'asc')
            ->get();

        // Collect all section images
        $images = $page->sections
            ->pluck('image')
            ->filter();

        return view('frontend.page', compact(
            'page',
            'images',
            'banners',
            'categories'
        ));
    }
}
