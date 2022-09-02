<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function(){
    //api/auth/register
    Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
    Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
    Route::get('/logout', 'App\Http\Controllers\Api\AuthController@logout')->middleware('auth:api');
    Route::get('/users', 'App\Http\Controllers\Api\AuthController@getAllUsers')->middleware('auth:api');
    Route::get('/users/{id}', 'App\Http\Controllers\Api\AuthController@getUserById')->middleware('auth:api');
    Route::get('authentication-failed', 'App\Http\Controllers\Api\AuthController@authFailed')->name('auth-failed');

});


Route::resource('blog','App\Http\Controllers\Api\BlogController');
//Route::group(['middleware' => 'auth:api'], function (){

    //properties

    Route::get('properties/recent','App\Http\Controllers\Api\PropertyController@getRecentProperties');
    Route::get('properties/popular','App\Http\Controllers\Api\PropertyController@getPopularProperties');
    Route::get('properties/featured','App\Http\Controllers\Api\PropertyController@getFeaturedProperties');
    Route::get('properties/category/{category_id}','App\Http\Controllers\Api\PropertyController@getPropertiesByCategoryId');
    Route::get('properties/related/{property_id}','App\Http\Controllers\Api\PropertyController@getRelatedPropertiesByPropertyId');
    Route::get('properties/user/{user_id}','App\Http\Controllers\Api\PropertyController@getUserPropertiesByUserId');
    Route::patch('properties/user/{property_id}','App\Http\Controllers\Api\PropertyController@updateProperty');
    //Route::get('properties/favorite/user/{user_id}','App\Http\Controllers\Api\PropertyController@getFavoritePropertiesByUserId');
    Route::patch('properties/favorite/{product_id}','App\Http\Controllers\Api\PropertyController@updateFavoriteByPropertyId');
    Route::resource('properties','App\Http\Controllers\Api\PropertyController');

    //blog post and comment
    Route::get('blog/comments/all/{post_id}','App\Http\Controllers\Api\BlogController@getPostComments');
    Route::get('blog/comments/first/{post_id}','App\Http\Controllers\Api\BlogController@getFirstPostComments');
    Route::post('blog/comments/create/{post_id}', 'App\Http\Controllers\Api\CommentsController@store');
    Route::resource('blogs','App\Http\Controllers\Api\BlogController');
    //Route::resource('blog','App\Http\Controllers\Api\BlogController');


    //categories
    Route::resource('categories','App\Http\Controllers\Api\CategoryController');


    Route::get('properties/favorite/user/{user_id}','App\Http\Controllers\Api\FavoriteController@userFavorites');
    Route::post('properties/favorite/{post_id}', 'App\Http\Controllers\Api\FavoriteController@favoriteProperty');
    Route::post('properties/unfavorite/{post_id}', 'App\Http\Controllers\Api\FavoriteController@unFavoriteProperty');



    Route::get('regions','App\Http\Controllers\Api\PropertyController@getAllRegions');
    Route::get('districts/{region_id}','App\Http\Controllers\Api\PropertyController@getDistrictsByRegionId');


    Route::get('categories','App\Http\Controllers\Api\PropertyController@getAllCategories');
    Route::get('subcategories/{category_id}','App\Http\Controllers\Api\PropertyController@getCategoriesByCategoryId');



    // ToDo: Upload Images for Opportunities and Forum
//});

//Route::get('regions','App\Http\Controllers\Api\PropertyController@getAllRegions');
//Route::post('districts','App\Http\Controllers\Api\PropertyController@getDistrictsByRegionId');
