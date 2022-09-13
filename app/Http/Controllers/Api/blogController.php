<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\CommentCollection;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BlogCollection
     */
    public function index()
    {

        $posts = Blog::with('author','comments')
            ->latestFirst()
            ->published()
            ->paginate(10);
        return new BlogCollection($posts);
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

    public function getFirstPostComments($post_id)
    {
        $post = Post::findorFail($post_id);
        $postComments = $post->comments()->latestFirst()->take(1)->get();
            //->with('author','comments')
            //->latestFirst();
            //->Paginate();
        return new CommentCollection($postComments);
    }

    public function getPostComments($post_id)
    {
        $post = Blog::findorFail($post_id);
        $postComments = $post->comments()
        ->with('blog')
        ->latest()
        ->Paginate(10);
        return new CommentCollection($postComments);
    }

}
