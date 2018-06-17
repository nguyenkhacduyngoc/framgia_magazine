<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
            $categories_topview = Category::with('posts')->get()->sortBy(function ($category) {
                return $category->posts->count();
            }, SORT_REGULAR, true)->take(self::NUMBER_TAG_HOMEPAGE);
            $tags = Tag::orderBy('created_at', 'desc')->take(self::NUMBER_TAG_HOMEPAGE)->get();
            $view->with([
                'categories' => $categories,
                'categories_topview' => $categories_topview,
                'tags' => $tags,
            ]);
        });
        view()->composer('backend.header', function ($view) {
            $auth_user = Auth::user();
            $view->with('auth_user', $auth_user);
        });
        view()->composer('frontend.sidebar', function ($view) {
            $categories = Category::with('posts')->get()->sortBy(function ($category) {
                return $category->posts->count();
            }, SORT_REGULAR, true);
            $tags = Tag::with('posts')
                ->where('created_at', '<', date('Y-m-d') . ' 00:00:00')
                ->where('created_at', '>=', date('Y-m-d', strtotime('7 days ago')) . ' 00:00:00')
                ->whereHas('posts', function ($query) {
                    $query->where('status', Post::POST_STATUS['accepted']);
                })
                ->orderBy('created_at', 'desc')
                ->get()
                ->sortBy(function ($category) {
                    return $category->posts->count();
                }, SORT_REGULAR, true);
            $mostviewed_posts = Post::hasCategory()
                ->orderBy('count_viewed', 'desc')
                ->where('status', Post::POST_STATUS['accepted'])
                ->limit(self::NUMBER_MOST_VIEWED_POSTS)
                ->get();
            $mostviewed_lastweek_posts = Post::hasCategory()
                ->orderBy('count_viewed', 'desc')
                ->where('status', Post::POST_STATUS['accepted'])
                ->where('updated_at', '<', date('Y-m-d') . ' 00:00:00')
                ->where('updated_at', '>=', date('Y-m-d', strtotime('7 days ago')) . ' 00:00:00')
                ->limit(self::NUMBER_MOST_VIEWED_POSTS)
                ->get();
            $view->with([
                'categories' => $categories,
                'tags' => $tags,
                'mostviewed_posts' => $mostviewed_posts,
                'mostviewed_lastweek_posts' => $mostviewed_lastweek_posts,
            ]);
        });
        User::deleting(function ($post) {
            // before delete() method call this
            // $post->comments()->delete();
            // do the rest of the cleanup...
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
