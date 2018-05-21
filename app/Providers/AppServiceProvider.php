<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.header', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
        view()->composer('backend.header', function ($view) {
            $auth_user = Auth::user();
            $view->with('auth_user', $auth_user);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
