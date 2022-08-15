<?php

////Command: php artisan make:controller 'Admin\AdminController' --resource

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\AdminDestroyRequest;

class AdminController extends BackendController 
{
    protected $limit = 5; 

     public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->uploadPath = public_path(config('cms.image.directory'));
    }

    public function dashboard()
    {
        return view('admin.administrator.dashboard');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins     = Admin::orderBy('user_name')->paginate($this->limit);
        $adminsCount = Admin::count();

        return view("admin.administrator.index", compact('admins', 'adminsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if($request->ajax()){
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;

            return $permissions;
        }
        $roles = Role::all();
        $admin = new Admin();
        return view("admin.administrator.create", compact('admin','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request)
    {
        //Admin::create($request->all());

         $data = $request->all();
         $data['password'] = bcrypt($data['password']);
         $admin = Admin::create($data);
        //$admin = Admin::create($request->all());
        //$admin->attachRole($request->role);

        // $admin->save();

        if($request->role != null){
             $admin->roles()->attach($request->role);
             $admin->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                 $admin->permissions()->attach($permission);
                 $admin->save();
            }
        }

        return redirect("/admin/admin")->with("message", "New admin was created successfully!");
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
        $admin = Admin::findOrFail($id);
        $roles = Role::get();
        $adminRole = $admin->roles->first();
        if($adminRole != null){
            $rolePermissions = $adminRole->permissions;
        }else{
            $rolePermissions = null;
        }
        $adminPermissions = $admin->permissions;


        return view("admin.administrator.edit", compact('admin','roles','adminRole','rolePermissions','adminPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        //Admin::findOrFail($id)->update($request->all());

        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        // $admin->save();

         $admin->roles()->detach();
         $admin->permissions()->detach();

        if($request->role != null){
             $admin->roles()->attach($request->role);
             $admin->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                 $admin->permissions()->attach($permission);
                 $admin->save();
            }
        }

        return redirect("/admin/admin")->with("message", "Admin was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminDestroyRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $deleteOption  = $request->delete_option;
        $selectedAdmin  = $request->selected_admin;

        if ($deleteOption == "delete") {
            // delete user blogs
            $admin->blogs()->withTrashed()->forceDelete();
        }
        elseif ($deleteOption == "attribute") {
            $admin->blogs()->update(['author_id' => $selectedAdmin]);
        }

        $admin->roles()->detach();
        $admin->permissions()->detach();
        $admin->delete();

        return redirect("/admin/admin")->with("message", "Admin was deleted successfully!");
    }

    public function confirm(AdminDestroyRequest $request, $id)
    {   

        $admin  = Admin::findOrFail($id);
        $admins = Admin::where('id', '!=', $admin->id)->pluck('email', 'id');

        return view("admin.administrator.confirm", compact('admin', 'admins'));
    }
}
