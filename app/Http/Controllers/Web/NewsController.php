<?php

namespace App\Http\Controllers\Web;

use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;
use Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('posts')->get();
        $posts = Post::orderBy('created_at', 'DESC')->limit(3)->get();

        return view("news.index", compact('categories', 'posts'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->with('user')
            ->with('categories')
            ->first();

        foreach ($post->categories as $category) {
            if ($category->access_id == Category::NEED_AUTH) {
                if (! Auth::check()) {
                    $post->body = str_limit($post->body, 250) . " <b>To Read More, you should to be logged in.</b>";

                }
            }
        }

        $comments = Comment::with('author')
            ->where('parent_id', 0)
            ->where('is_posted', 1)
            ->where('post_id', $post->id)
            ->paginate(10);

        if (!$post) {
            abort(404);
        }

        return view('news.show', compact('post', 'comments'));
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
