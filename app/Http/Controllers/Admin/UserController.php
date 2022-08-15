<?php

////Command: php artisan make:controller 'user\UserController' --resource

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDestroyRequest;

class UserController extends BackendController 
{
    protected $limit = 5; 

     public function __construct()
    {
        $this->middleware('auth:admin');
        $this->uploadPath = public_path(config('cms.image.directory'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      = User::orderBy('user_name')->paginate($this->limit);
        $usersCount = User::count();

        return view("admin.user.index", compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $user = new User();
        return view("admin.user.create", compact('user','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //User::create($request->all());

         $data = $request->all();
         $data['password'] = bcrypt($data['password']);

         //dd($data);
         $user = User::create($data);

        //$user = User::create($request->all());
        //$user->attachRole($request->role);

        return redirect("/admin/user")->with("message", "New user was created successfully!");
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
        $user = User::findOrFail($id);

        return view("admin.user.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //User::findOrFail($id)->update($request->all());

        $user = User::findOrFail($id);
        $user->update($request->all());

        //$user->detachRoles();
        //$user->attachRole($request->role);


        return redirect("/admin/user")->with("message", "User was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $deleteOption  = $request->delete_option;
        $selectedUser  = $request->selected_user;

        if ($deleteOption == "delete") {
            // delete user properties
            $user->properties()->withTrashed()->forceDelete();
        }
        elseif ($deleteOption == "attribute") {
            $user->properties()->update(['owner_id' => $selectedUser]);
        }

        $user->delete();

        return redirect("/admin/user")->with("message", "User was deleted successfully!");
    }

    public function confirm(UserDestroyRequest $request, $id)
    {   

        $user  = User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->pluck('email', 'id');

        return view("admin.user.confirm", compact('user', 'users'));
    }
}
