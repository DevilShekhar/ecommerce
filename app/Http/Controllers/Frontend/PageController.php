<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log; // Add this for logging

class PageController extends Controller
{
    public function home()
    {
        $page = Page::query()
            ->where('status', true)
            ->with([
                'sections' => function ($query) {
                    $query->where('status', true)
                        ->orderBy('sort_order');
                },
            ])
            ->firstOrFail();

        $banners = Banner::query()
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhereDate('start_date', '<=', today());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', today());
            })
            ->orderBy('sort_order')
            ->get();

        $categories = ProductCategory::query()
            ->where('status', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', 1);
                },
            ])
            ->orderBy('name', 'asc')
            ->get();

        $featuredProducts = Product::where('is_futured', 1)
            ->where('status', 1)
            ->with(['category', 'brand'])
            ->take(8)
            ->get();

        $newProducts = Product::where('is_futured', 2)
            ->where('status', 1)
            ->with(['category', 'brand'])
            ->take(8)
            ->get();
        $availableProducts = Product::where('stock', '>', 0)
            ->latest()
            ->get();

        $aboutUs = AboutUs::where('status', 1)->first();

        Log::info('About Us Data:', ['aboutUs' => $aboutUs ? 'Found' : 'Not Found']);
        if ($aboutUs) {
            Log::info('About Us Title:', ['title' => $aboutUs->about_title]);
        }

        return view('frontend.page', compact(
            'page',
            'banners',
            'categories',
            'featuredProducts',
            'newProducts',
            'aboutUs', 'availableProducts'
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

        $banners = Banner::query()
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhereDate('start_date', '<=', today());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', today());
            })
            ->orderBy('sort_order')
            ->get();

        $categories = ProductCategory::query()
            ->where('status', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', 1);
                },
            ])
            ->orderBy('name', 'asc')
            ->get();

        $images = $page->sections
            ->pluck('image')
            ->filter();

        $featuredProducts = Product::where('is_futured', 1)
            ->where('status', 1)
            ->with(['category', 'brand'])
            ->take(8)
            ->get();

        $newProducts = Product::where('is_futured', 2)
            ->where('status', 1)
            ->with(['category', 'brand'])
            ->take(8)
            ->get();

        $aboutUs = AboutUs::get();

        // DEBUG: Check if aboutUs exists
        Log::info('About Us Data (show method):', ['aboutUs' => $aboutUs ? 'Found' : 'Not Found']);
        if ($aboutUs) {
            Log::info('About Us Title:', ['title' => $aboutUs->about_title]);
        }

        return view('frontend.page', compact(
            'page',
            'images',
            'banners',
            'categories',
            'featuredProducts',
            'newProducts',
            'aboutUs'
        ));
    }
}
