<?php

 //Command: php artisan make:controller 'Admin\PropertyCategoryController' --resource


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyCategory;
use App\Models\Property;
use App\Http\Requests\PropertyCategoryStoreRequest;
use App\Http\Requests\PropertyCategoryUpdateRequest;
use App\Http\Requests\PropertyCategoryDestroyRequest ;


class PropertyCategoryController extends BackendController 
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
        $categories      = PropertyCategory::with('properties')->orderBy('title')->paginate($this->limit);
        $categoriesCount = PropertyCategory::count();

        return view("admin.property_category.index", compact('categories', 'categoriesCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $category = new PropertyCategory();
        return view("admin.property_category.create", compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(PropertyCategoryStoreRequest $request)
    {
        PropertyCategory::create($request->all());

        return redirect("/admin/property_category")->with("message", "New category was created successfully!");
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
        $category = PropertyCategory::findOrFail($id);

        return view("admin.property_category.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyCategoryUpdateRequest $request, $id)
    {
        PropertyCategory::findOrFail($id)->update($request->all());

        return redirect("/admin/property_category")->with("message", "Category was updated successfully!");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyCategoryDestroyRequest $request, $id)
    {
        Property::withTrashed()
        ->where('category_id', $id)
        ->update(['category_id' => config('cms.default_category_id')]);

        $category = PropertyCategory::findOrFail($id);
        $category->delete();

        return redirect("/admin/property_category")->with("message", "Category was deleted successfully!");
    }
}
