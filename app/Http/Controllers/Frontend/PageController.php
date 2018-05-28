<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PageController extends Controller
{
    const CATEGORY_PAGINATE = 5;

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

            return view('frontend.homepage', compact('posts'));
        } catch (Exception $e) {
            return abort('404');
        }
    }

    public function category($id)
    {
        try {
            $category = Category::findOrFail($id);
            $posts = $category->posts()->where('status', Post::POST_STATUS['accepted'])->paginate(self::CATEGORY_PAGINATE);

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
