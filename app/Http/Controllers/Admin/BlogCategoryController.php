<?php

 //Command: php artisan make:controller 'Admin\BlogCategoryController' --resource


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Http\Requests\BlogCategoryStoreRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryDestroyRequest ;


class BlogCategoryController extends BackendController 
{
    protected $limit = 5; 

     public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->uploadPath = public_path(config('cms.image.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories      = BlogCategory::with('blogs')->orderBy('title')->paginate($this->limit);
        $categoriesCount = BlogCategory::count();

        return view("admin.blog_category.index", compact('categories', 'categoriesCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $category = new BlogCategory();
        return view("admin.blog_category.create", compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(BlogCategoryStoreRequest $request)
    {
        BlogCategory::create($request->all());

        return redirect("/admin/blog_category")->with("message", "New category was created successfully!");
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
        $category = BlogCategory::findOrFail($id);

        return view("admin.blog_category.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        BlogCategory::findOrFail($id)->update($request->all());

        return redirect("/admin/blog_category")->with("message", "Category was updated successfully!");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategoryDestroyRequest $request, $id)
    {
        Blog::withTrashed()
        ->where('category_id', $id)
        ->update(['category_id' => config('cms.default_category_id')]);

        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return redirect("/admin/blog_category")->with("message", "Category was deleted successfully!");
    }
}
