<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    const POST_PAGINATE = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(self::POST_PAGINATE);

        return view('backend.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();

            return view('backend.posts.view', compact('post'));
        } catch (Exception $e) {
            return redirect('admin');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();

            return view('backend.posts.update', ['post' => $post]);
        } catch (Exception $e) {
            return redirect('admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validate = Post::validateApprovePost($request->all());
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($request->all());
        }
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();
            if ($post->category == null) {
                return redirect()->route('admin.posts.index');
            }
            $post->update($request->all());

            return redirect()->route('admin.posts.index');
        } catch (Exception $e) {
            return redirect()->route('admin.posts.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->orWhere('id', $slug)
                ->firstOrFail();
            $post->tags()->detach();
            $post->delete();

            return redirect()->route('admin.posts.index');
        } catch (Exception $e) {
            return redirect()->route('admin');
        }
    }
}
