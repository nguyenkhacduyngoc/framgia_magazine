<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    const NUMBER_TAG_HOMEPAGE = 4;
    const NUMBER_MOST_VIEWED_POSTS = 10;
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
            $mostviewed_posts = Post::orderBy('count_viewed', 'desc')->take(self::NUMBER_MOST_VIEWED_POSTS)->get();
            $view->with([
                'categories' => $categories,
                'tags' => $tags,
                'mostviewed_posts' => $mostviewed_posts,
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
