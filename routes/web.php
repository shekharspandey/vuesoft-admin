<?php

use App\Http\Middleware\GuestAdmin;
use App\Models\SiteModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\AdminAuth;

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

Route::middleware(GuestAdmin::class)->group(function () {
    Route::get('/', [SiteController::class, 'login'])->name('/');
    Route::get('/login', [SiteController::class, 'login'])->name('login');
    Route::post('/signin', [SiteController::class, 'signin'])->name('signin');
    Route::get('/register', [SiteController::class, 'register'])->name('register');
    Route::post('/signup', [SiteController::class, 'signup'])->name('signup');
    Route::get('/forgot-password', [SiteController::class, 'forgotPassword'])->name('forgotPassword');
});

Route::post('/logout', [SiteController::class, 'logout'])->name('logout');

Route::middleware(AdminAuth::class)->group(function () {
    Route::get('/profile', [SiteController::class, 'profile'])->name('profile');
    Route::post('update-profile', [SiteController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/profile/change-password', [SiteController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [SiteController::class, 'updatePassword'])->name('updatePassword');
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [SiteController::class, 'users'])->name('users');
    Route::get('/users/data', [SiteController::class, 'usersData'])->name('users.data');
    Route::get('/users/{id}', [SiteController::class, 'userDetails'])->name('userDetails');
    Route::get('/services', [SiteController::class, 'services'])->name('services');
    Route::get('/faqs', [SiteController::class, 'faqs'])->name('faqs');
    Route::get('/faqs/data', [SiteController::class, 'faqsData'])->name('faqs.data');
    Route::get('/terms', [SiteController::class, 'terms'])->name('terms');
    Route::get('/privacy-policy', [SiteController::class, 'privacyPolicy'])->name('privacyPolicy');
    Route::post('/save-privacy-policy', [SiteController::class, 'savePrivacyPolicy'])->name('save.privacy.policy');
    Route::post('/save-terms', [SiteController::class, 'saveTerms'])->name('save.terms');
});
