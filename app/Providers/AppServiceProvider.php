<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    const NUMBER_TAG_HOMEPAGE = 4;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.header', function ($view) {
            $categories = Category::all();
            $tags = Tag::orderBy('created_at', 'desc')->take(self::NUMBER_TAG_HOMEPAGE)->get();
            $view->with([
                'categories' => $categories,
                'tags' => $tags,
            ]);
        });
        view()->composer('backend.header', function ($view) {
            $auth_user = Auth::user();
            $view->with('auth_user', $auth_user);
        });
        view()->composer('frontend.sidebar', function ($view) {
            $categories = Category::all();
            $tags = Tag::all();
            $view->with([
                'categories' => $categories,
                'tags' => $tags,
            ]);
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
