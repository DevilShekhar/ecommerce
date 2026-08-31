<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CheckoutController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\Admin\CustomerAccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\LogoController;
use App\Http\Controllers\admin\OfferCategoryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\admin\OrderReturnController; 
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PageSectionController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\WarehouseController;
use App\Http\Controllers\admin\WishlistController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\DisclaimerController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\TermsConditionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\ProductCategory;

Route::get('/server', function () {
    return view('errors.500');
});
// Route::get('/', function () {
//     return view('frontend.layouts.app');
// });

// Social Login Routes
Route::get('/auth/google', [SocialLoginController::class, 'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogle']);
Route::get('/auth/facebook', [SocialLoginController::class, 'redirectFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [SocialLoginController::class, 'handleFacebook']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about-us', [AboutUsController::class, 'index'])
    ->name('about-us');
Route::get('/terms-conditions', [TermsConditionsController::class, 'index'])
    ->name('terms-conditions');
Route::get('/contact-us', [ContactUsController::class, 'index'])
    ->name('contact-us');

Route::post('/contact-inquiry', [ContactSubmissionController::class, 'storeInquiry'])
    ->name('contact-inquiry.store');

Route::get('/disclaimer', [DisclaimerController::class, 'index'])
    ->name('disclaimer');
Route::get('/', [FrontendPageController::class, 'home'])
    ->name('home');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])
    ->name('privacy-policy.index');

Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {
        Route::get('/about-us', [AboutUsController::class, 'adminIndex'])->name('about-us.index');
        Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('about-us.create');
        Route::post('/about-us', [AboutUsController::class, 'store'])->name('about-us.store');
        Route::get('/about-us/{aboutUs}/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
        Route::put('/about-us/{aboutUs}', [AboutUsController::class, 'update'])->name('about-us.update');
        Route::delete('/about-us/{aboutUs}', [AboutUsController::class, 'destroy'])->name('about-us.destroy');

        Route::get('/terms-conditions', [TermsConditionsController::class, 'adminIndex'])->name('terms-conditions.index');
        Route::get('/terms-conditions/create', [TermsConditionsController::class, 'create'])->name('terms-conditions.create');
        Route::post('/terms-conditions', [TermsConditionsController::class, 'store'])->name('terms-conditions.store');
        Route::get('/terms-conditions/{termsConditions}/edit', [TermsConditionsController::class, 'edit'])->name('terms-conditions.edit');
        Route::put('/terms-conditions/{termsConditions}', [TermsConditionsController::class, 'update'])->name('terms-conditions.update');
        Route::delete('/terms-conditions/{termsConditions}', [TermsConditionsController::class, 'destroy'])->name('terms-conditions.destroy');

        Route::get('contact-us', [ContactUsController::class, 'adminIndex'])->name('contact-us.index');
        Route::get('contact-us/create', [ContactUsController::class, 'create'])->name('contact-us.create');
        Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');
        Route::get('contact-us/{id}/edit', [ContactUsController::class, 'edit'])->name('contact-us.edit');
        Route::put('contact-us/{id}', [ContactUsController::class, 'update'])->name('contact-us.update');
        Route::delete('contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');

        Route::get('/disclaimers', [DisclaimerController::class, 'adminIndex'])->name('disclaimers.index');
        Route::get('/disclaimers/create', [DisclaimerController::class, 'create'])->name('disclaimers.create');
        Route::post('/disclaimers', [DisclaimerController::class, 'store'])->name('disclaimers.store');
        Route::get('/disclaimers/{disclaimer}/edit', [DisclaimerController::class, 'edit'])->name('disclaimers.edit');
        Route::put('/disclaimers/{disclaimer}', [DisclaimerController::class, 'update'])->name('disclaimers.update');
        Route::delete('/disclaimers/{disclaimer}', [DisclaimerController::class, 'destroy'])->name('disclaimers.destroy');

        Route::get('/privacy-policies', [PrivacyPolicyController::class, 'adminIndex'])->name('privacy-policies.index');
        Route::get('/privacy-policies/create', [PrivacyPolicyController::class, 'create'])->name('privacy-policies.create');
        Route::post('/privacy-policies', [PrivacyPolicyController::class, 'store'])->name('privacy-policies.store');
        Route::get('/privacy-policies/{privacyPolicy}/edit', [PrivacyPolicyController::class, 'edit'])->name('privacy-policies.edit');
        Route::put('/privacy-policies/{privacyPolicy}', [PrivacyPolicyController::class, 'update'])->name('privacy-policies.update');
        Route::delete('/privacy-policies/{privacyPolicy}', [PrivacyPolicyController::class, 'destroy'])->name('privacy-policies.destroy');
    });

// Add after your about-us route
Route::get('/shops', [ShopController::class, 'index'])
    ->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])
    ->name('shop.show');
Route::get('/get-subcategories/{categoryId}', [ShopController::class, 'getSubCategories'])
    ->name('shop.subcategories');

Route::get('/shops/filter', [ShopController::class, 'filter'])->name('shop.filter');

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

    Route::get('/dashboard/download-report', [DashboardController::class, 'downloadReport'])->name('dashboard.download.report');
    Route::get('/dashboard/download-excel-report', [DashboardController::class, 'downloadExcelReport'])->name('dashboard.download.excel');
    Route::get('products/get-subcategories/{category_id}', [ProductController::class, 'getSubCategories'])->name('products.get.subcategories');

    Route::prefix('admin')
        ->middleware(['auth'])
        ->name('admin.')
        ->group(function () {

            Route::get('products', [ProductController::class, 'index'])->name('products.index');
            Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('products', [ProductController::class, 'store'])->name('products.store');
            Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
            Route::get('products/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('products/{product:slug}', [ProductController::class, 'update'])->name('products.update');
            Route::patch('products/{product:slug}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('products/{product:slug}', [ProductController::class, 'destroy'])->name('products.destroy');

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
    Route::get('offer/products-by-category', [OfferController::class, 'getProductsByCategory'])->name('admin.offer.products-by-category');
    Route::resource('offer', OfferController::class)->except(['show'])->names('admin.offer');
});

// Wishlist Routes (Old)
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'dest'])->name('wishlist.remove');
});
// =============================================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/customer-dashboard', [DashboardController::class, 'customerDashboard'])->name('customer.dashboard');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Customer Wishlist
    Route::get('/customer/wishlist', [WishlistController::class, 'index'])->name('customer.wishlist');
    Route::post('/customer/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('customer.wishlist.toggle');
    Route::delete('/customer/wishlist/remove/{id}', [WishlistController::class, 'destroy'])->name('customer.wishlist.remove');
    Route::get('/customer/products', [DashboardController::class, 'customerProducts'])->name('customer.products');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/customer/cart/add/{productId}', [CheckoutController::class, 'addToCart'])->name('cart.add');
    Route::post('/customer/notify-me', [CheckoutController::class, 'store'])->name('customer.notify-me');
    Route::get('/customer/product-details/{id}', [DashboardController::class, 'getProductDetails'])->name('customer.product.details');

    Route::post('/products/{product}/add-stock', [ProductController::class, 'addStock'])->name('products.add-stock');
    Route::delete('/cart/remove/{key}', [CheckoutController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::post('/cart/update/{key}', [CheckoutController::class, 'updateCart'])->name('cart.update');
    Route::get('/checkout/addresses', [CheckoutController::class, 'getAddresses'])->name('checkout.addresses');
    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');

    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('customer.orders.cancel');
    Route::patch('/orders/{order}/return', [OrderController::class, 'requestReturn'])->name('customer.orders.return');
    Route::get('/orders/returns/{return}', [OrderReturnController::class, 'show'])->name('orders.returns.show');
    Route::post('/orders/returns/{return}/approve', [OrderReturnController::class, 'approve'])->name('orders.returns.approve');
    Route::post('/orders/returns/{return}/reject', [OrderReturnController::class, 'reject'])->name('orders.returns.reject');
    Route::post('/orders/returns/{return}/refund', [OrderReturnController::class, 'refund'])->name('orders.returns.refund');
    Route::post('/orders/rating', [OrderController::class, 'submitRating'])->name('customer.orders.rating');

    // Products / Shop
    Route::get('/shop', [ProductController::class, 'index'])->name('shop');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.details');

    Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('product.category');
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');

    // Account Settings
    Route::get('/account-settings', [CustomerAccountController::class, 'accountSettings'])->name('account.settings');

    Route::put('/account-settings', [CustomerAccountController::class, 'updateAccountSettings'])->name('account.settings.update');
    Route::put('/account/password', [CustomerAccountController::class, 'updatePassword'])->name('account.password.update');
    Route::post('/users/send-offer', [UserController::class, 'sendOffer'])->name('users.send-offer');

    // Addresses
    Route::post('/account-addresses', [CustomerAccountController::class, 'storeAddress'])->name('account.addresses.store');
    Route::put('/account-addresses/{addressId}/default', [CustomerAccountController::class, 'setDefaultAddress'])->name('account.addresses.default');
    Route::delete('/account-addresses/{addressId}', [CustomerAccountController::class, 'deleteAddress'])->name('account.addresses.delete');
    Route::put('/account-addresses/{addressId}', [CustomerAccountController::class, 'updateAddress'])->name('account.addresses.update');

    // Password
    Route::put('/account-password', [CustomerAccountController::class, 'updatePassword'])->name('account.password.update');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout/create-razorpay-order', [CheckoutController::class, 'createRazorpayOrder'])->name('checkout.create.razorpay.order')
        ->middleware('auth');
    Route::post('/checkout/verify-razorpay-payment', [CheckoutController::class, 'verifyRazorpayPayment'])->name('checkout.verify.razorpay')
        ->middleware('auth');
    Route::get('/my-orders', [OrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/customer/returns-refunds', [CustomerAccountController::class, 'returns'])->name('customer.returns.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('customer.orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status.update');
});

require __DIR__.'/auth.php';
Route::post('/pages/{page}/sections/{section}/contact', [ContactSubmissionController::class, 'store'])->name('frontend.contact.submit');
Route::get('/customer/product-detail/{id}', [ProductController::class, 'getDetail'])
    ->name('customer.product.detail');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/search', function (Request $request) {
    $q = $request->input('q');
    if (!$q) return response()->json(['products' => [], 'categories' => []]);

    return response()->json([
        'categories' => ProductCategory::query()->where('name', 'LIKE', "%{$q}%")->limit(5)->get(['id','name']),
        'products' => Product::query()->where('name', 'LIKE', "%{$q}%")->limit(8)->get(['id','name','slug','price','image'])
    ]);
});
