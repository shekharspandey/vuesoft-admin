<?php

use App\Models\SiteModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Site\BlogController;

Route::fallback(function () {
    $data['design_services'] = SiteModel::getAllHeaderServices("Design Solutions");
    $data['web_services'] = SiteModel::getAllHeaderServices("Web Solutions");
    $data['mobile_services'] = SiteModel::getAllHeaderServices("Mobile Solutions");
    $data['seo_services'] = SiteModel::getAllHeaderServices("SEO Services");
    $data['digital_services'] = SiteModel::getAllHeaderServices("Digital Marketing");
    return response()->view('errors.404', $data, 404);
});

Route::get('/clear-cache', function () {
    try {
        Artisan::call('optimize:clear');
        Artisan::call('optimize');
        return response()->json(['message' => 'All cache cleared successfully!']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error clearing cache: ' . $e->getMessage()], 500);
    }
});

Route::get('/', [SiteController::class, 'login'])->name('/');
Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::post('/signin', [SiteController::class, 'signin'])->name('signin');
Route::get('/register', [SiteController::class, 'register'])->name('register');
Route::post('/signup', [SiteController::class, 'signup'])->name('signup');
Route::get('/forgot-password', [SiteController::class, 'forgotPassword'])->name('forgotPassword');

Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');
Route::get('/users', [SiteController::class, 'users'])->name('users');
Route::get('/services', [SiteController::class, 'services'])->name('services');
