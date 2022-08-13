<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| Theme Front End Routes
|--------------------------------------------------------------------------
*/


Route::group(
    [ 
    'namespace' => 'App\Http\Controllers\Theme',
    ], 
    function () {

        //Index - homePage
        Route::get('/', [
            'uses' => 'HomeController@index',
            'as'   => 'index',
        ]);

        //FeaturedProperties
        Route::get('/featured', [
            'uses' => 'PropertyController@featuredProperties',
            'as'   => 'featured',
        ]);

        //LastestProperties
        Route::get('/lastest', [
            'uses' => 'PropertyController@lastestProperties',
            'as'   => 'lastest',
        ]);

        //rentProperties
        route::get('/rent', [
            'uses' => 'PropertyController@rentProperties',
            'as'   => 'rent',
        ]);

        //saleProperties
        Route::get('/sale', [
            'uses' => 'PropertyController@saleProperties',
            'as'   => 'sale',
        ]);

        //cityProperties
        Route::get('/city', [
            'uses' => 'PropertyController@cityProperties',
            'as'   => 'city',
        ]);

        //properties
        Route::get('/properties', [
            'uses' => 'PropertyController@properties',
            'as'   => 'properties'
        ]); 

                
        //propertyDetail
        Route::get('/property/{property}', [
            'uses' => 'PropertyController@propertyDetail',
            'as'   => 'property.detail'
        ]);
        //property by category
        Route::get('/category/{category}', [
            'uses' => 'PropertyController@propertyCategory',
            'as'   => 'property.category'
        ]);

        //property by owner/user
        Route::get('/owner/{owner}', [
            'uses' => 'PropertyController@propertyOwner',
            'as'   => 'property.owner'
        ]); 




        //Front end blog post
        Route::get('/blogs', [
            'uses' => 'BlogController@blogs',
            'as' =>'blogs'
         ]); 
        //blog detail
        Route::get('/blog/{blog}', [
            'uses' => 'BlogController@blogDetail',
            'as'   => 'blog.detail'
         ]); 

        //blogs by category
         Route::get('/blog_category/{blog_category}', [
           'uses' => 'BlogController@blogCategory',
           'as'   => 'blog.category'
           ]); 
        //blogs by author
         Route::get('/author/{author}', [
            'uses' => 'BlogController@blogAuthor',
            'as'   => 'blog.author'
         ]); 

        ///blogs by tag
         Route::get('/tag/{tag}', [
            'uses' => 'BlogController@blogTag',
            'as'   => 'blog.tag'
        ]);


         //About 
        Route::get('/about', [
            'uses' => 'PageController@about',
            'as'   => 'about',
        ]);

        //mission
        Route::get('/mission', [
            'uses' => 'PageController@mission',
            'as'   => 'mission',
        ]);

        //Team
        Route::get('/team', [
            'uses' => 'PageControllerr@team',
            'as'   => 'team',
        ]);

        //Contact
        Route::get('/contact', [
            'uses' => 'PageController@contact',
            'as'   => 'contact',
        ]);


        // Route For Ajax Function
        Route::get('/get/main-categories', 'PropertyController@getMainCategeories');
        Route::get('/get/sub-categories/{category_id}', 'PropertyController@getSubCategories');
        Route::get('/get/districts/{region_id}', 'PropertyController@getDistricts');





    }
            
);



/*---------------------End of Theme Front End Routes -----------------------*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(
    [ 

    'namespace' => 'App\Http\Controllers\Auth',
    //'middleware' => 'auth', 
    'prefix' => 'admin'
    ], 
    function () {

        //Auth admin users routes
        
        Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
        Route::get('/logout', 'AdminLoginController@adminLogout')->name('admin.logout');

        // Password reset routes
        Route::post('/password/email', 'AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'AdminResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    
    }
);


Route::group(
    [ 

    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => ['auth:admin'], 
    'prefix' => 'admin',
    ], 
    function () {
        //Dashborads Admin routes
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::put('/blog/restore/{blog}', 'BlogController@restore')->name('admin.blog.restore');
        Route::delete('/blog/force-destroy/{blog}', 'BlogController@forceDestroy')->name('admin.blog.force-destroy');
        Route::put('/property/restore/{property}', 'PropertyController@restore')->name('admin.property.restore');
        Route::delete('/property/force-destroy/{property}', 'PropertyController@forceDestroy')->name('admin.property.force-destroy');
      

        Route::resource('/blog',  'BlogController', 
        ['names' => [
          'index'    => 'admin.blog.index',
          'store'    => 'admin.blog.store',
          'create'   => 'admin.blog.create',
          'update'   => 'admin.blog.update',
          'show'     => 'admin.blog.show',
          'destroy'  => 'admin.blog.destroy',
          'edit'     => 'admin.blog.edit',
        ]]);

        Route::resource('/blog_category',  'BlogCategoryController', 
        ['names' => [
          'index'    => 'admin.blog_category.index',
          'store'    => 'admin.blog_category.store',
          'create'   => 'admin.blog_category.create',
          'update'   => 'admin.blog_category.update',
          'show'     => 'admin.blog_category.show',
          'destroy'  => 'admin.blog_category.destroy',
          'edit'     => 'admin.blog_category.edit',
         ]]);

         Route::resource('/property',  'PropertyController', 
        ['names' => [
          'index'    => 'admin.property.index',
          'store'    => 'admin.property.store',
          'create'   => 'admin.property.create',
          'update'   => 'admin.property.update',
          'show'     => 'admin.property.show',
          'destroy'  => 'admin.property.destroy',
          'edit'     => 'admin.property.edit',
        ]]);

        Route::resource('/property_category',  'PropertyCategoryController', 
        ['names' => [
          'index'    => 'admin.property_category.index',
          'store'    => 'admin.property_category.store',
          'create'   => 'admin.property_category.create',
          'update'   => 'admin.property_category.update',
          'show'     => 'admin.property_category.show',
          'destroy'  => 'admin.property_category.destroy',
          'edit'     => 'admin.property_category.edit',
         ]]);


     


    }



);

/*--------------------End of Admin outes--------------------------------*/

  

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/users/logout', 'App\Http\Controllers\Auth\LoginController@userLogout')->name('users.logout');
//Route::get('/users/submit-property', 'App\Http\Controllers\HomeController@submitProperty')->name('user.submit-property');
//Route::get('/users/my-properties', 'App\Http\Controllers\HomeController@myProperties')->name('users.my-properties');
//Route::get('/users/my-favorite','App\Http\Controllers\UserPropertyController@userFavorites')->name('users.my-favorites');
