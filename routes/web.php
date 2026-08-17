<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CheckoutController;
use App\Http\Controllers\admin\ContactSubmissionController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\CustomerAccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LogoController;
use App\Http\Controllers\admin\OfferCategoryController;
use App\Http\Controllers\admin\OfferController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PageSectionController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\WarehouseController;
use App\Http\Controllers\admin\WishlistController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/server', function () {
    return view('errors.500');
});

// Social Login Routes
Route::get('/auth/google', [SocialLoginController::class, 'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogle']);
Route::get('/auth/facebook', [SocialLoginController::class, 'redirectFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [SocialLoginController::class, 'handleFacebook']);

// =============================================
// ✅ REMOVE DUPLICATE DASHBOARD ROUTE
// =============================================
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');  // ← REMOVE THIS

// Profile Routes (Laravel Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('roles/{role}/permissions-data', [RoleController::class, 'getPermissionsData'])
        ->name('roles.permissions.data');
    Route::get('roles/{role}/permissions', [RoleController::class, 'managePermissions'])
        ->name('roles.permissions');
    Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])
        ->name('roles.permissions.update');
    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('product_categories', ProductCategoryController::class);
    Route::resource('sub_categories', SubCategoryController::class);
    Route::get('get-subcategories/{id}', [BrandController::class, 'getSubCategories']);
    Route::resource('coupons', CouponController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('products', ProductController::class);

    Route::get('products/get-subcategories/{category_id}', [ProductController::class, 'getSubCategories'])
        ->name('products.get.subcategories');

    Route::prefix('admin')
        ->middleware(['auth'])
        ->name('admin.')
        ->group(function () {
            Route::resource('pages', PageController::class);
            Route::get('pages/{page}/sections', [PageSectionController::class, 'index'])->name('pages.sections.index');
            Route::get('pages/{page}/sections/create', [PageSectionController::class, 'create'])->name('pages.sections.create');
            Route::post('pages/{page}/sections', [PageSectionController::class, 'store'])->name('pages.sections.store');
            Route::get('pages/{page}/sections/{section}/edit', [PageSectionController::class, 'edit'])->name('pages.sections.edit');
            Route::put('pages/{page}/sections/{section}', [PageSectionController::class, 'update'])->name('pages.sections.update');
            Route::delete('pages/{page}/sections/{section}', [PageSectionController::class, 'destroy'])->name('pages.sections.destroy');
            Route::resource('offer-category', OfferCategoryController::class);
            Route::resource('offer', OfferController::class);
            Route::resource('banners', BannerController::class);
        });

    Route::get('/logos', [LogoController::class, 'index'])->name('logos.index');
    Route::post('/logos/update', [LogoController::class, 'update'])->name('logos.update');
    Route::get('contact-submissions', [ContactSubmissionController::class, 'index'])->name('admin.contact-submissions.index');
    Route::get('contact-submissions/{submission}', [ContactSubmissionController::class, 'show'])->name('admin.contact-submissions.show');
    Route::resource('offer', OfferController::class)
        ->except(['show'])
        ->names('admin.offer');
    Route::get('offer/products-by-category', [OfferController::class, 'getProductsByCategory'])->name('admin.offer.products-by-category');
});

// Wishlist Routes (Old)
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

// =============================================
// ✅ CUSTOMER DASHBOARD ROUTES - ONLY ONE
// =============================================
Route::middleware(['auth'])->group(function () {

    // Dashboard - SINGLE ROUTE
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================================
    // NEW: Customer Dashboard
    // ================================
    Route::get('/customer-dashboard', [DashboardController::class, 'customerDashboard'])
        ->name('customer.dashboard');

    // Profile - Add missing routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Customer Wishlist
    Route::get('/customer/wishlist', [WishlistController::class, 'index'])
        ->name('customer.wishlist');

    Route::post('/customer/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])
        ->name('customer.wishlist.toggle');

    Route::delete('/customer/wishlist/remove/{id}', [WishlistController::class, 'destroy'])
        ->name('customer.wishlist.remove');
    Route::get('/customer/products', [DashboardController::class, 'customerProducts'])
        ->name('customer.products');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])
        ->name('checkout');

    Route::post('/cart/add/{productId}', [CheckoutController::class, 'addToCart'])
        ->name('cart.add');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

    // Cart Routes - Uncomment when CartController exists
    // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    // Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    // Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Products / Shop
    Route::get('/shop', [ProductController::class, 'index'])->name('shop');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.details');
    Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('product.category');
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    // Account Settings
    Route::get('/account-settings', [CustomerAccountController::class, 'accountSettings'])
        ->name('account.settings');

    Route::put('/account-settings', [CustomerAccountController::class, 'updateAccountSettings'])
        ->name('account.settings.update');

    // Addresses
    Route::post('/account-addresses', [CustomerAccountController::class, 'storeAddress'])
        ->name('account.addresses.store');

    Route::put('/account-addresses/{addressId}/default', [CustomerAccountController::class, 'setDefaultAddress'])
        ->name('account.addresses.default');

    Route::delete('/account-addresses/{addressId}', [CustomerAccountController::class, 'deleteAddress'])
        ->name('account.addresses.delete');

    Route::put('/account-addresses/{addressId}', [CustomerAccountController::class, 'updateAddress'])
        ->name('account.addresses.update');

    // Password
    Route::put('/account-password', [CustomerAccountController::class, 'updatePassword'])
        ->name('account.password.update');
});

// Public Routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/about', function () {
    return view('about');
})->name('about');

require __DIR__.'/auth.php';

// Frontend Pages
Route::get('/', [FrontendPageController::class, 'home'])->name('home');
Route::get('/{slug}', [FrontendPageController::class, 'show'])
    ->where('slug', '.*')
    ->name('frontend.page');
Route::post('/pages/{page}/sections/{section}/contact', [ContactSubmissionController::class, 'store'])->name('frontend.contact.submit');
