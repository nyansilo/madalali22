<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\Comment as CommentResource;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @return CommentResource
     */
    public function store($post_id, Request $request)
    {
//        $comment = Comment::create([
//            'question_id' => $request->questionId,
//            'created_id' => $request->createdBy,
//            'comment' => $request->comment
//        ]);
//        return new CommentResource($comment);

         //$post = Post::findorFail($id);
        //$post->comments()->create($request->all());

        $validator = Validator::make($request->all(),[
            'authorName' => 'required|string',
            'authorEmail' => 'required|string',
            'commentBody' => 'required|string',


        ]);

        if($validator->fails()){
            return response(['errors' => $validator->errors()], 422);
        }

         $post = Post::findorFail($post_id);
         $post->createComment([
         'author_name' => $request->authorName,
         'author_email' => $request->authorEmail,
         'body' => $request->commentBody,
        ]);
         return response('Comment Successfully Added',200);
        // return new CommentResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    public function getPostComments(Post $post)
    {
        $postComments = $post->comments()->Paginate(3);
        return new CommentCollection($postComments);
    }
}
