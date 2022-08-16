<?php

//Command: php artisan make:controller 'Theme\CommentController'

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\BlogComment;
use App\Models\Blog;


class CommentController extends Controller
{
   public function store(Blog $blog, CommentStoreRequest $request)
    {
        //data = $request->all();
        //$data['post_id'] = $post->id;
        //comment::create($data);
        //OR $blog->comments()->create($request->all());
        $blog->createComment($request->all());

        return redirect()->back()->with('message', "Your comment successfully send.");
    }

    
}
