<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PostViewed;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use App\Models\Rate;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    const POST_PAGINATE = 5;

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'ratePost', 'likePost']]);
    }

    protected function validatePost(array $data)
    {
        return Validator::make($data, [
            'category_id' => 'required',
            'title' => 'required|string',
            'content' => 'required',
            'img' => 'image|max:2000',
        ]);
    }

    protected function createPost(array $data)
    {
        return Post::create($data);
    }

    protected function updatePost(array $data, $slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();
            if ($post->status == 0) {
                return redirect()->route('homepage');
            }
            return $post->update($data);
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }

    }

    protected function queryCategoriesArray()
    {
        $categories = Category::select('id', 'name')->get();
        $categories_array = [];
        foreach ($categories as $category) {
            $categories_array[$category->id] = $category->name;
        }

        return $categories_array;
    }

    protected function uploadImage($image)
    {
        if ($image != null) {
            $image_name = $image->getClientOriginalName();
            $image->move('upload/posts', $image_name);

            return $image_name;
        }
        return null;
    }

    protected function attachTags($tags, $post)
    {
        $tags = explode(",", $tags);

        foreach ($tags as $tag_content) {
            $tag = Tag::where('content', $tag_content)->first();
            if ($tag == null) {
                $tag = Tag::create(['content' => $tag_content]);
            }
            if (!$post->tags()->where('content', $tag_content)->exists()) {
                $post->tags()->attach($tag->id);
            }
        }

        return $tags;
    }

    protected function isExistRate($rate_data)
    {
        return (Rate::where('user_id', $rate_data['user_id'])
                ->where('post_id', $rate_data['post_id'])->first() != null);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->where('status', '<>', Post::POST_STATUS['rejected'])->get();
        return view('frontend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_array = $this->queryCategoriesArray();

        return view('frontend.posts.create', compact('categories_array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validatePost($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        $user_id = Auth::user()->id;
        $post_data = [
            'category_id' => $request['category_id'],
            'user_id' => $user_id,
            'title' => $request['title'],
            'subtitle' => $request['subtitle'],
            'content' => $request['content'],
            'status' => 0,
            'avg_rate' => 0,
        ];
        $image_name = $this->uploadImage($request->image);
        if ($image_name != null) {
            $post_data['img'] = $image_name;
        }

        $post = $this->createPost($post_data);
        $this->attachTags($request->tag, $post);

        return redirect()->route('homepage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();
            if ($post->status == Post::POST_STATUS['accepted']) {
                $categories_array = $this->queryCategoriesArray();
                event(new PostViewed($post));
                $post->update();
                if (Auth::check()) {
                    $user = Auth::user();
                    $like = Like::where('user_id', $user->id)
                        ->where('post_id', $post->id)
                        ->first();
                    $user_rate = $user->rates()->select('rate')->where('post_id', $post->id)->first();
                }

                return view('frontend.posts.view', compact('post', 'categories_array', 'user_rate', 'like'));
            }

            return abort('404');

        } catch (Exception $e) {
            return abort('404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();
            if ($post->status != 0) {
                request()->session()->flash('status', trans('auth.cant_edit_post'));
                return redirect()->back();
            }
            if ($post->user->id == Auth::user()->id) {
                $categories_array = $this->queryCategoriesArray();
                $tags_array = [];
                foreach ($post->tags()->get() as $tag) {
                    $tags_array[$tag->id] = $tag->content;
                }
                return view('frontend.posts.update', compact('post', 'categories_array', 'tags_array'));
            }
            return abort('404');
        } catch (Exception $e) {
            return abort('404');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validate = $this->validatePost($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        $post = Post::where('slug', $slug)
            ->orWhere('id', $slug)
            ->firstOrFail();
        $user_id = Auth::user()->id;
        $post_data = [
            'category_id' => $request['category_id'],
            'user_id' => $user_id,
            'title' => $request['title'],
            'subtitle' => $request['subtitle'],
            'content' => $request['content'],
        ];
        if ($request->image != null) {
            $img = $request->image;
            $post_data['img'] = $img->getClientOriginalName();
            $img->move('upload/posts', $img->getClientOriginalName());
        }
        $post->update($post_data);
        $this->attachTags($request->tag, $post);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $categories = Category::where('id', '>', 0)->pluck('id')->toArray();
        $posts = Post::whereIn('category_id', $categories)
            ->where('status', 2)
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%');
                $query->orwhereHas('tags', function ($query) use ($keyword) {
                    $query->where('content', 'LIKE', '%' . $keyword . '%');
                });
                $query->orWhere('content', 'LIKE', '%' . $keyword . '%');
            })->paginate(self::POST_PAGINATE);
        return view('frontend.search', compact('posts', 'keyword'));
    }

    public function ratePost(Request $request)
    {
        try {
            if ($request->ajax()) {
                $post = Post::where('slug', $request->slug)
                    ->orWhere('id', $request->slug)
                    ->firstOrFail();
                $user = Auth::user();
                $rate_data = [
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'rate' => $request->star_rate,
                ];
                $rate = Rate::where('user_id', $rate_data['user_id'])
                    ->where('post_id', $rate_data['post_id'])
                    ->first();
                if ($rate != null) {
                    $rate->update($rate_data);
                } else {
                    $rate = Rate::create($rate_data);
                }

                return view('frontend.posts.rate', compact('rate', 'post'));
            }
        } catch (Exception $e) {
            return abort('404');
        }
    }

    protected function checkSoftDelete($like_data)
    {
        return (Like::onlyTrashed()
                ->where('user_id', $like_data['user_id'])
                ->where('post_id', $like_data['post_id'])
                ->first() != null);
    }
    public function likePost(Request $request)
    {
        try {
            if ($request->ajax()) {
                $post = Post::where('slug', $request->slug)
                    ->orWhere('id', $request->slug)
                    ->firstOrFail();
                $user = Auth::user();
                $like_data = [
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ];
                $like = Like::where('user_id', $like_data['user_id'])
                    ->where('post_id', $like_data['post_id'])
                    ->first();
                if ($like == null) {
                    if ($this->checkSoftDelete($like_data)) {
                        $like = Like::onlyTrashed()
                            ->where('user_id', $like_data['user_id'])
                            ->where('post_id', $like_data['post_id'])
                            ->restore();
                    } else {
                        Like::create($like_data);
                        $like = Like::where('user_id', $like_data['user_id'])
                            ->where('post_id', $like_data['post_id'])->get();
                    }
                    return $like;
                } else {
                    $like->delete();

                    return null;
                }
            }
        } catch (Exception $e) {
            return abort('404');
        }
    }
}
