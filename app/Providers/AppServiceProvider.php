<?php

namespace App\Providers;

use App\Models\SiteModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::composer('site.common.header', function ($view) {
        //     $view->with('services', [
        //         'design_services' => SiteModel::getAllHeaderServices("Design Solutions"),
        //         'web_services' => SiteModel::getAllHeaderServices("Web Solutions"),
        //         'mobile_services' => SiteModel::getAllHeaderServices("Mobile Solutions"),
        //         'seo_services' => SiteModel::getAllHeaderServices("SEO Services"),
        //         'digital_services' => SiteModel::getAllHeaderServices("Digital Marketing"),
        //     ]);
        // });
    }
}
