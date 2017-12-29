<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('author')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        $commentCount = Comment::count();

        return view('admin.comments.index', compact('comments', 'commentCount'));
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
        $comment = Comment::findOrFail($id);

        return view("admin.comments.edit", compact('comment'));
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
        $data = $request->all();

        $comment = Comment::findOrFail($id);
        $comment->update($data);

        return redirect('/admin/comments')->with('message', 'Comment was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);

        return redirect('/admin/comments')->with('message', 'Comment was deleted successfully!');
    }

    public function activeChange($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_posted = !$comment->is_posted;
        $comment->save();
    }
}
