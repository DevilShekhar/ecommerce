<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Home
        $urls[] = [
            'loc' => url('/'),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];

        // Static pages
        $pages = [
            '/about-us' => ['monthly', '0.8'],
            '/contact-us' => ['monthly', '0.7'],
            '/terms-conditions' => ['yearly', '0.5'],
            '/privacy-policy' => ['yearly', '0.5'],
            '/disclaimer' => ['yearly', '0.5'],
            '/shops' => ['daily', '0.9'],
        ];

        foreach ($pages as $url => $settings) {
            $urls[] = [
                'loc' => url($url),
                'changefreq' => $settings[0],
                'priority' => $settings[1],
            ];
        }

        // Products
        Product::with('category')
            ->select('id', 'category_id', 'name', 'updated_at')
            ->chunk(500, function ($products) use (&$urls) {

                foreach ($products as $product) {

                    if (!$product->category) {
                        continue;
                    }

                    $categorySlug = Str::slug($product->category->name);
                    $productSlug = Str::slug($product->name);

                    $urls[] = [
                        'loc' => url(
                            '/' . $categorySlug . '/' . $productSlug
                        ),
                        'lastmod' => optional($product->updated_at)->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                    ];
                }
            });

        // Categories
        ProductCategory::select('id', 'name', 'updated_at')
            ->chunk(500, function ($categories) use (&$urls) {

                foreach ($categories as $category) {

                    $urls[] = [
                        'loc' => url(
                            '/' . Str::slug($category->name)
                        ),
                        'lastmod' => optional($category->updated_at)->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.7',
                    ];
                }
            });

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }
}