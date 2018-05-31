<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PageController extends Controller
{
    const CATEGORY_PAGINATE = 5;
    const NUMBER_POST_HOMEPAGE = 4;

    public function index()
    {
        $posts = [
            'sliders' => Post::sliders(),
            'lastest' => Post::lastest(),
            'lastest_paginates' => Post::lastestPaginate(),
            'more_news' => Post::moreNews(),
        ];
        try {
            if (empty($posts['sliders']) || empty($posts['lastest']) || empty($posts['lastest_paginates']) || empty($posts['more_news'])) {
                throw new Exception();
            }
            $categories = Category::with('posts')->get()->sortBy(function ($category) {
                return $category->posts->count();
            }, SORT_REGULAR, true)->take(self::NUMBER_POST_HOMEPAGE);
            return view('frontend.homepage', compact('posts', 'categories'));
        } catch (Exception $e) {
            return abort('404');
        }
    }

    public function category($id)
    {
        try {
            $category = Category::findOrFail($id);
            $posts = $category->posts()->where('status', Post::POST_STATUS['accepted'])->orderBy('created_at', 'desc')->paginate(self::CATEGORY_PAGINATE);

            return view('frontend.category', compact('category', 'posts'));
        } catch (Exception $e) {
            return view('frontend.homepage');
        }
    }

    public function tag($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $posts = $tag->posts()->where('status', 2)->paginate(self::CATEGORY_PAGINATE);

            return view('frontend.tag', compact('tag', 'posts'));
        } catch (Exception $e) {
            return view('frontend.homepage');
        }
    }

}
