<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PostViewed;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    const POST_PAGINATE = 5;
    const POST_STATUS = [
        'Pending',
        'Rejected',
        'Accepted',
    ];

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update']]);
    }

    protected function validatePost(array $data)
    {
        return Validator::make($data, [
            'category' => 'required',
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(self::POST_PAGINATE);
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
            'category_id' => $request['category'],
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
            if ($post->status == 2) {
                $categories_array = $this->queryCategoriesArray();
                event(new PostViewed($post));
                $post->update();

                return view('frontend.posts.view', compact('post', 'categories_array'));
            }
            return redirect()->route('homepage');

        } catch (Exception $e) {
            return redirect()->route('homepage');
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
            if ($post->user->id == Auth::user()->id) {
                $categories_array = $this->queryCategoriesArray();
                $tags_array = [];
                foreach ($post->tags()->get() as $tag) {
                    $tags_array[$tag->id] = $tag->content;
                }
                return view('frontend.posts.update', compact('post', 'categories_array', 'tags_array'));
            }
            return redirect()->route('homepage');
        } catch (Exception $e) {
            return redirect()->route('homepage');
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
        $post_data = $request->all();
        if ($request->image != null) {
            $img = $request->image;
            $post_data['img'] = $img->getClientOriginalName();
            $img->move('upload/posts', $img->getClientOriginalName());
        }
        $post->update($post_data);
        $this->attachTags($request->tag, $post);
        return redirect()->route('homepage');
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
        $posts = Post::where('title', 'LIKE', '%' . $keyword . '%')
            ->orwhereHas('tags', function ($query) use ($keyword) {
                $query->where('content', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhere('content', 'LIKE', '%' . $keyword . '%')
            ->paginate(Post::NUMBER_PAGENATE_SEARCH);
        return view('frontend.search', compact('posts', 'keyword'));
    }
}
