<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyCollection;
use App\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function userFavorites($user_id)
    {
        $user = User::findorFail($user_id);
        $userFavorites = $user->favorites;
        //dd($userFavorites);
        return new PropertyCollection($userFavorites);
    }

    public function favoriteProperty($post_id)
    {

        //$request->user('api');
        //auth('api')->user();
        auth('api')->user()->favorites()->attach($post_id);
        return response('Attached',200);

        //return back();
    }


    public function unFavoriteProperty($post_id)
    {
        auth('api')->user()->favorites()->detach($post_id);
        return response('Detached',200);

        //return back();
    }
}