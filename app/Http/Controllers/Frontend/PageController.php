<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PageController extends Controller
{

    public function index()
    {
        $posts = [
            'sliders' => Post::sliders(),
            'lastest' => Post::lastest(),
            'lastest_paginates' => Post::lastestPaginate(),
            'more_news' => Post::moreNews(),
        ];

        return view('frontend.homepage', compact('posts'));
    }

}
