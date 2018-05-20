<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    protected function updatePost(array $data, $id)
    {
        try {
            $post = Post::findOrFail($id);

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.posts.my-post');
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

        if ($request->image != null) {
            $img = $request->image;
            $post_data['img'] = $img->getClientOriginalName();
            $img->move('upload/posts', $img->getClientOriginalName());
        }

        $post = $this->createPost($post_data);

        return redirect()->route('homepage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            $categories_array = $this->queryCategoriesArray();

            return view('frontend.posts.index', compact('post', 'categories_array'));
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
    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
            if ($post->user->id == Auth::user()->id) {
                $categories_array = $this->queryCategoriesArray();

                return view('frontend.posts.update', compact('post', 'categories_array'));
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
    public function update(Request $request, $id)
    {
        $validate = $this->validatePost($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        $post = Post::findOrFail($id);
        $post_data = $request->all();
        if ($request->image != null) {
            $img = $request->image;
            $post_data['img'] = $img->getClientOriginalName();
            $img->move('upload/posts', $img->getClientOriginalName());
        }
        $post->update($post_data);

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
}
