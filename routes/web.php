<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\Admin\BlogController;

use Illuminate\Support\Facades\Log;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth/google', [SocialLoginController::class,'redirectGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialLoginController::class,'handleGoogle']);

Route::get('/auth/facebook', [SocialLoginController::class,'redirectFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [SocialLoginController::class,'handleFacebook']);
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('blogs', BlogController::class);   
});

require __DIR__.'/auth.php';
