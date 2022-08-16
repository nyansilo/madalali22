<?php

//Command: php artisan make:controller 'Theme\BlogController'

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Admin; 

class BlogController extends Controller
{
   protected $limit = 3;

    public function blogs(){

        
        //\DB::enableQueryLog();
        //$posts = Post::all();
        //$posts = Post::with('author')->get();
        //return view('hotelfront.blog', compact('posts'))->render();
        //dd(\DB::getQueryLog());

        //$posts = Post::with('author')->orderBy('created_at','desc')->get();


        //this is bad practise repeating code we will use the composer service provider instead
        //$categories = BlogCategory::with(['blogs' => function($query) {
            //$query->published();
        //}])->orderBy('title', 'asc')->get(); 

        $categories = BlogCategory::with('blogs')->orderBy('title', 'asc')->get(); 


        $tags = Tag::with('blogs')->orderBy('name', 'asc')->get();


        $blogs = Blog::with('author','category','comments')
                    ->latestFirst()
                    ->published()
                    //->filter(request('term'))
                    ->Paginate($this->limit);
        $popularBlogs = Blog::with('author','category','comments')
                    ->popular()
                    ->latestFirst()
                    ->published()
                    ->Paginate(4);
                 

        return view('theme.blog.blogs', compact('blogs','categories','popularBlogs','tags'));
        
    }

    //public function category($id)
    //Get all blogs for particular category
    public function blogCategory(BlogCategory $blog_category)
    {
        $categoryName = $blog_category->title;

         

        $categories = BlogCategory::with('blogs')->orderBy('title', 'asc')->get(); 
   
        $blogs =  $blog_category->blogs()
                            ->with('author','comments')
                            ->latestFirst()
                            ->published()
                            ->Paginate($this->limit);

        $popularBlogs = Blog::with('author','category','comments')
                        ->popular()
                        ->latestFirst()
                        ->published()
                        ->Paginate(4);

        $tags = Tag::with('blogs')->orderBy('name', 'asc')->get();                 


                        
        return view('theme.blog.blogs', compact('blogs','categoryName','categories','popularBlogs','tags'));

    }

    //Get all blogs for particular category
    public function blogTag(Tag $tag)
    {
        $tagName = $tag->name;


        $categories = BlogCategory::with('blogs')->orderBy('title', 'asc')->get(); 

        $tags = Tag::with('blogs')->orderBy('name', 'asc')->get(); 

        $blogs = $tag->blogs()
                          ->with('author', 'category','comments')
                          ->latestFirst()
                          ->published()
                          ->Paginate($this->limit);

        $popularBlogs = Blog::with('author','category','comments')
                    ->popular()
                    ->latestFirst()
                    ->published()
                    ->Paginate(4);                 
         return view("theme.blog.blogs", compact('blogs', 'tagName','categories','popularBlogs','tags'));
    }

    //Get all blogs for particular author
    public function blogAuthor(Admin $author)
    {
        $authorName = $author->full_name;

        $categories = BlogCategory::with('blogs')->orderBy('title', 'asc')->get();

        $tags = Tag::with('blogs')->orderBy('name', 'asc')->get(); 

        $blogs =  $author->blogs()
                            ->with('category','tags','comments')
                            ->latestFirst()
                            //->published()
                            ->Paginate($this->limit);

        $popularBlogs = Blog::with('author','category','comments')
                    ->popular()
                    ->latestFirst()
                    ->published()
                    ->Paginate(4); 

        return view('theme.blog.blogs', compact('blogs','authorName','categories','tags','popularBlogs'));

    }

    public function blogDetail(Blog $blog){
       
       
        //this is bad practise repeating code we will use the composer service provider instead
        /*  $categories = Category::with('posts')->orderBy('title', 'asc')->get();
        
        return view('hotelfront.postdetail', compact('post','categories'));
         */


         // increament the view count in the database the clicked link/refreshed but should ip session for 
         //improvement


         //update posts set view_count = view_count + 1 whare id=?
         #method 1
         //$viewCount = (int)$post->view_count + 1;
         //$post->update('view_count' => $viewCount);

         #method 2:
        (int)$blog->increment('view_count');

        $categories = BlogCategory::with('blogs')->orderBy('title', 'asc')->get(); 

        $tags = Tag::with('blogs')->orderBy('name', 'asc')->get(); 


        $blogComments = $blog->comments()->simplePaginate(3);

        $popularBlogs = Blog::with('author','category','comments')
                    ->popular()
                    ->latestFirst()
                    ->published()
                    ->Paginate(4);

        $relatedBlogs  = $blog->relatedPost(4, true)->with('author','category','comments')->get();            

        return view('theme.blog.blog_detail', compact('blog', 'blogComments','categories','popularBlogs','relatedBlogs','tags'));
        
        
    }
}
