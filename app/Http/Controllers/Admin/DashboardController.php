<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DashboardReportExport;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\InventoryTransaction;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductRating;
use App\Models\User;
use App\Models\UserOffer;
use App\Models\Wishlist;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user->hasRole('SuperAdmin')) {
            return redirect()->route('customer.dashboard');
        }
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 1)->count();
        $inactiveProducts = Product::where('status', 0)->count();
        $featuredProducts = Product::where('is_futured', 1)->count();

        $totalCustomers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Customer');
        })->count();

        $activeCustomers = User::where('status', 1)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Customer');
            })
            ->count();

        $totalBrands = Brand::count();

        $activeBrands = Brand::where('status', 1)->count();

        $totalCategories = ProductCategory::count();

        $totalCoupons = Coupon::count();

        $activeCoupons = Coupon::where('status', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();

        $expiredCoupons = Coupon::whereDate('end_date', '<', now())->count();

        $totalOffers = Offer::count();

        $activeOffers = Offer::where('status', 1)->count();

        $totalStock = Product::sum('stock');

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->count();

        $outOfStockProducts = Product::where('stock', '<=', 0)->count();

        $totalStockIn = InventoryTransaction::where('type', 'stock_in')
            ->sum('quantity');

        $totalStockOut = InventoryTransaction::where('type', 'stock_out')
            ->sum('quantity');

        $todayStockIn = InventoryTransaction::where('type', 'stock_in')
            ->whereDate('created_at', today())
            ->sum('quantity');

        $todayStockOut = InventoryTransaction::where('type', 'stock_out')
            ->whereDate('created_at', today())
            ->sum('quantity');

        $totalRatings = ProductRating::count();

        $averageRating = ProductRating::avg('rating');

        $averageRating = $averageRating
            ? number_format($averageRating, 1)
            : 0;

        $recentProducts = Product::with([
            'category',
            'subCategory',
            'brand',
        ])
            ->latest()
            ->take(5)
            ->get();

        $recentInventoryTransactions = InventoryTransaction::with([
            'product',
            'creator',
        ])
            ->latest()
            ->take(5)
            ->get();

        $lowStockProductList = Product::with([
            'category',
            'brand',
        ])
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(10)
            ->get();

        $topRatedProducts = Product::select(
            'products.id',
            'products.name',
            'products.image',
            'products.price',
            'products.stock',
            DB::raw('AVG(product_ratings.rating) as average_rating'),
            DB::raw('COUNT(product_ratings.id) as total_reviews')
        )
            ->join(
                'product_ratings',
                'products.id',
                '=',
                'product_ratings.product_id'
            )
            ->groupBy(
                'products.id',
                'products.name',
                'products.image',
                'products.price',
                'products.stock'
            )
            ->orderByDesc('average_rating')
            ->orderByDesc('total_reviews')
            ->take(5)
            ->get();

        $brandWiseProducts = Brand::select(
            'brands.name',
            DB::raw('COUNT(products.id) as total_products')
        )
            ->leftJoin(
                'products',
                'brands.id',
                '=',
                'products.brand_id'
            )
            ->groupBy('brands.id', 'brands.name')
            ->orderByDesc('total_products')
            ->take(10)
            ->get();

        $categoryWiseProducts = ProductCategory::select(
            'product_categories.name',
            DB::raw('COUNT(products.id) as total_products')
        )
            ->leftJoin(
                'products',
                'product_categories.id',
                '=',
                'products.category_id'
            )
            ->groupBy(
                'product_categories.id',
                'product_categories.name'
            )
            ->orderByDesc('total_products')
            ->take(10)
            ->get();

        $monthlyProducts = Product::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $monthlyProductLabels = [];
        $monthlyProductData = [];

        for ($month = 1; $month <= 12; $month++) {

            $monthlyProductLabels[] = Carbon::create()
                ->month($month)
                ->format('M');

            $monthlyProductData[] =
                $monthlyProducts[$month]->total ?? 0;
        }

        return view('dashboard', compact(

            // Products
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'featuredProducts',

            // Customers
            'totalCustomers',
            'activeCustomers',

            // Brands
            'totalBrands',
            'activeBrands',

            // Categories
            'totalCategories',

            // Coupons
            'totalCoupons',
            'activeCoupons',
            'expiredCoupons',

            // Offers
            'totalOffers',
            'activeOffers',

            // Inventory
            'totalStock',
            'lowStockProducts',
            'outOfStockProducts',
            'totalStockIn',
            'totalStockOut',
            'todayStockIn',
            'todayStockOut',

            // Ratings
            'totalRatings',
            'averageRating',

            // Lists
            'recentProducts',
            'recentInventoryTransactions',
            'lowStockProductList',
            'topRatedProducts',

            // Reports
            'brandWiseProducts',
            'categoryWiseProducts',
            'monthlyProductLabels',
            'monthlyProductData'
        ));
    }

    public function downloadReport()
    {
        $user = Auth::user();

        $totalCustomers = User::whereHas('role', function ($query) {
            $query->where('name', 'customer');
        })->count();

        $activeCustomers = User::whereHas('role', function ($query) {
            $query->where('name', 'customer');
        })
            ->where('status', 1)
            ->count();

        $totalProducts = Product::count();

        $activeProducts = Product::query()->where('status', 1)->count();

        $totalBrands = Brand::count();

        $activeBrands = Brand::query()->where('status', 1)->count();

        $totalCategories = ProductCategory::count();

        $totalCoupons = Coupon::count();

        $activeCoupons = Coupon::query()->where('status', 1)->count();

        $totalOffers = Offer::count();

        $activeOffers = Offer::query()->where('status', 1)->count();

        $totalStock = Product::sum('stock');

        $outOfStockProducts = Product::query()->where('stock', '<=', 0)->count();

        $lowStockProducts = Product::query()->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->count();

        $totalRatings = ProductRating::count();

        $averageRating = ProductRating::avg('rating') ?? 0;

        $totalStockIn = InventoryTransaction::where('type', 'stock_in')
            ->sum('quantity');

        $totalStockOut = InventoryTransaction::where('type', 'stock_out')
            ->sum('quantity');

        $todayStockIn = InventoryTransaction::where('type', 'stock_in')
            ->whereDate('created_at', today())
            ->sum('quantity');

        $todayStockOut = InventoryTransaction::where('type', 'stock_out')
            ->whereDate('created_at', today())
            ->sum('quantity');

        $recentProducts = Product::with('category')
            ->latest()
            ->take(10)
            ->get();

        $lowStockProductList = Product::with('category')
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(10)
            ->get();

        $recentInventoryTransactions = InventoryTransaction::with([
            'product',
            'creator',
        ])
            ->latest()
            ->take(10)
            ->get();

        $data = compact(
            'user',
            'totalCustomers',
            'activeCustomers',
            'totalProducts',
            'activeProducts',
            'totalBrands',
            'activeBrands',
            'totalCategories',
            'totalCoupons',
            'activeCoupons',
            'totalOffers',
            'activeOffers',
            'totalStock',
            'outOfStockProducts',
            'lowStockProducts',
            'totalRatings',
            'averageRating',
            'totalStockIn',
            'totalStockOut',
            'todayStockIn',
            'todayStockOut',
            'recentProducts',
            'lowStockProductList',
            'recentInventoryTransactions'
        );

        $pdf = Pdf::loadView('admin.dashboard-report', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download(
            'dashboard-report-'.now()->format('d-m-Y-H-i').'.pdf'
        );
    }

    public function downloadExcelReport()
    {
        return Excel::download(
            new DashboardReportExport,
            'dashboard-report-'.now()->format('d-m-Y-H-i').'.xlsx'
        );
    }

    /**
     * Customer Dashboard
     */
    public function customerDashboard()
    {
        $user = Auth::user();

        // Only customer can access
        if (! $user->hasRole('customer')) {
            return redirect()->route('dashboard');
        }

        // Wishlist
        $wishlistProducts = Wishlist::query()->where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->get();

        $wishlistCount = $wishlistProducts->count();

        // Categories
        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->take(7)
            ->get();

        // Recommended Products
        $recommendedProducts = Product::query()->where('status', 1)
            ->latest()
            ->take(8)
            ->get();
        $banners = Banner::query()->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->get();

        $orderStatusCounts = [
            'pending' => Order::where('order_status', 'pending')->count(),
            'confirmed' => Order::where('order_status', 'confirmed')->count(),
            'processing' => Order::where('order_status', 'processing')->count(),
            'packed' => Order::where('order_status', 'packed')->count(),
            'shipped' => Order::where('order_status', 'shipped')->count(),
            'out_for_delivery' => Order::where('order_status', 'out_for_delivery')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
            'cancelled' => Order::where('order_status', 'cancelled')->count(),
        ];
        // Inside the controller method
        $now = now()->toDateString();

        $activeOffers = Offer::query()->where('status', 1)
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->get();

        $recommendedProducts->each(function ($product) use ($activeOffers) {
            $offer = $activeOffers->first(function ($o) use ($product) {
                return $o->apply_to === 'product' && $o->product_id == $product->id;
            });
            if (! $offer) {
                $offer = $activeOffers->first(function ($o) use ($product) {
                    return $o->apply_to === 'category' && $o->product_category_id == $product->category_id;
                });
            }

            $product->active_offer = $offer;
        });

        $sentOffers = UserOffer::with('offer')
            ->where('user_id', Auth::id())
            ->where('status', 1)
            ->latest('sent_at')
            ->get();

        $couponCount = $sentOffers->whereNotNull('coupon_code')->count();

        return view('customer.dashboard', compact(
            'user',
            'wishlistCount',
            'wishlistProducts',
            'categories',
            'recommendedProducts',
            'banners',
            'orderStatusCounts',
            'couponCount',
            'sentOffers'
        ));
    }

    /**
     * Customer Products
     */
    public function customerProducts()
    {
        $user = Auth::user();

        // Only customer can access
        if (! $user->hasRole('customer')) {
            return redirect()->route('dashboard');
        }

        // Products added to wishlist by this customer
        $wishlistProducts = Wishlist::query()->where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->get();

        $wishlistCount = $wishlistProducts->count();

        // Categories
        $categories = ProductCategory::query()->where('status', 1)
            ->latest()
            ->take(7)
            ->get();
        $recommendedProducts = Product::query()->where('status', 1)
            ->latest()
            ->take(8)
            ->get();
        // Inside the controller method
        $now = now()->toDateString();

        $activeOffers = Offer::query()->where('status', 1)
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->get();

        $recommendedProducts->each(function ($product) use ($activeOffers) {
            $offer = $activeOffers->first(function ($o) use ($product) {
                return $o->apply_to === 'product' && $o->product_id == $product->id;
            });
            if (! $offer) {
                $offer = $activeOffers->first(function ($o) use ($product) {
                    return $o->apply_to === 'category' && $o->product_category_id == $product->category_id;
                });
            }

            $product->active_offer = $offer;
        });

        return view('customer.products', compact(
            'user',
            'wishlistProducts',
            'wishlistCount',
            'categories', 'recommendedProducts'
        ));
    }

    public function getProductDetails($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $images = $product->image
            ? array_values(array_filter(array_map('trim', explode(',', $product->image))))
            : [];

        $firstImage = $images[0] ?? null;

        if ($firstImage) {
            $firstImage = preg_replace('#^storage/#', '', $firstImage);
            $imageUrl = asset($firstImage);
        } else {
            $imageUrl = asset('images/placeholder.png');
        }

        $discount = $product->discount ?? 0;
        $originalPrice = $product->price ?? 0;
        $price = $originalPrice - ($originalPrice * $discount / 100);

        return response()->json([
            'success' => true,

            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name ?? 'Jewellery',
                'price' => $price,
                'formatted_price' => '₹'.number_format($price, 0),
                'image' => $imageUrl,
                'description' => $product->specification ?? 'No product description available.',
                'stock' => $product->stock,
                'is_out_of_stock' => $product->stock !== null && $product->stock <= 0,
                'is_futured' => (int) ($product->is_futured ?? 0) === 1,
            ],
        ]);
    }
}
