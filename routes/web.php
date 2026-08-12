<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ContactSubmissionController;
use App\Http\Controllers\admin\CouponController;
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
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth/google', [SocialLoginController::class, 'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogle']);

Route::get('/auth/facebook', [SocialLoginController::class, 'redirectFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [SocialLoginController::class, 'handleFacebook']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
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

    // AJAX Route for Dependent SubCategories Dropdown
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
        });
    Route::get('/logos', [LogoController::class, 'index'])
        ->name('logos.index');

    Route::post('/logos/update', [LogoController::class, 'update'])
        ->name('logos.update');
    Route::get('contact-submissions', [ContactSubmissionController::class, 'index'])->name('admin.contact-submissions.index');
    Route::get('contact-submissions/{submission}', [ContactSubmissionController::class, 'show'])->name('admin.contact-submissions.show');

});
require __DIR__.'/auth.php';

Route::get('/{slug}', [FrontendPageController::class, 'show'])
    ->where('slug', '.*')
    ->name('frontend.page');
Route::post('/pages/{page}/sections/{section}/contact', [ContactSubmissionController::class, 'store'])->name('frontend.contact.submit');
