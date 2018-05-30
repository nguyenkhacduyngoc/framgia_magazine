<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    const COMMENTABLE_TYPE = ['post', 'comment'];

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['storeComment', 'storeReplyComment']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    }

    public function storeComment(Request $request)
    {
        try {
            if ($request->ajax()) {

                $post = Post::where('slug', $request->id)
                    ->orWhere('id', $request->id)
                    ->firstOrFail();

                $validate = Comment::validateComment($request->all());
                if ($validate->fails()) {
                    return redirect()->back()->withErrors($validate)->withInput($request->all());
                }
                $user_id = Auth::user()->id;
                $comment_data = [
                    'user_id' => $user_id,
                    'content' => $request['content'],
                ];
                $post->comments()->create($comment_data);

                return view('frontend.posts.comment', compact('post'));
            }

            return redirect()->route('homepage');
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }
    }

    public function storeReplyComment(Request $request)
    {
        try {
            if ($request->ajax()) {
                $post = Post::where('slug', $request->slug)
                    ->orWhere('id', $request->slug)
                    ->firstOrFail();
                $comment = Comment::where('id', $request->id)->firstOrFail();
                $user_id = Auth::user()->id;

                $comment_data = [
                    'user_id' => $user_id,
                    'content' => $request['content'],
                ];
                $validate = Comment::validateComment($comment_data);
                if ($validate->fails()) {
                    return view('frontend.posts.comment', compact('post'))->withErrors($validate)->withInput($request->all());
                }
                $comment->comment()->create($comment_data);

                return view('frontend.posts.comment', compact('post'));
            }

            return redirect()->route('homepage');
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }
    }

    public function destroyComment(Request $request)
    {
        try {
            if ($request->ajax()) {
                $post = Post::where('slug', $request->slug)
                    ->orWhere('id', $request->slug)
                    ->firstOrFail();
                $comment = Comment::where('id', $request->id)->firstOrFail();
                $comment->delete();

                return view('frontend.posts.comment', compact('post'));
            }

            return redirect()->route('homepage');
        } catch (Exception $e) {
            return redirect()->route('homepage');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
