<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    const POST_PAGINATE = 5;

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
        $posts = Post::orderBy('created_at', 'desc')->get();
        // paginate(self::POST_PAGINATE);

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
                ->firstOrFail();
            $categories_array = $this->queryCategoriesArray();
            $slider_option_array = Post::SLIDER_OPTIONS;

            return view('backend.posts.view', compact('post', 'categories_array', 'slider_option_array'));
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
            // ->orWhere('id', $slug)
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
            // ->orWhere('id', $slug)
                ->firstOrFail();
            if ($request['slider'] == 'side') {
                if ($post->status != 2 && ($request['status'] != 2)) {
                    $request->session()->flash('status', trans('admin.need_approve'));

                    return redirect()->back();
                }
                if (($post->slider != 'side') && Post::where('slider', 'side')->count() >= 2) {
                    $request->session()->flash('status', trans('admin.enough_slider_side'));

                    return redirect()->back();
                }
            }

            if ($request['slider'] == 'main') {
                if ($post->status != 2 && ($request['status'] != 2)) {
                    $request->session()->flash('status', trans('admin.need_approve'));

                    return redirect()->back();
                }
                if (($post->slider != 'main') && Post::where('slider', 'main')->count() >= 5) {
                    $request->session()->flash('status', trans('admin.enough_slider_main'));

                    return redirect()->back();
                }
            }
            $post_data = [
                'category_id' => $request['category_id'],
                'status' => $request['status'],
                'slider' => $request['slider'],
            ];
            // dd($post_data);
            $post->update($post_data);

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
