<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Models\Role;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        // crud post
        $crudPost = new Permission();
        $crudPost->name = "crud-post";
        $crudPost->slug = "crud-post";
        $crudPost->save();
        $crudPost->id;
        

        // update others post
        $updateOthersPost = new Permission();
        $updateOthersPost->name = "update-others-post";
        $updateOthersPost->slug = "update-others-post";
        $updateOthersPost->save();

        $updateOthersPost->id;

        // delete others post
        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = "delete-others-post";
        $deleteOthersPost->slug = "delete-others-post";
        $deleteOthersPost->save();
        $deleteOthersPost->id;

        // crud category
        $crudCategory = new Permission();
        $crudCategory->name = "crud-category";
        $crudCategory->slug = "crud-category";
        $crudCategory->save();
        $crudCategory->id;

        // crud user
        $crudUser = new Permission();
        $crudUser->name = "crud-user";
        $crudUser->slug = "crud-user";
        $crudUser->save();
        $crudUser->id;

        // attach roles permissions
        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();


        $admin->permissions()->detach([$crudPost->id, $updateOthersPost->id, $deleteOthersPost->id, $crudCategory->id, $crudUser->id]);
        $admin->permissions()->attach([$crudPost->id, $updateOthersPost->id, $deleteOthersPost->id, $crudCategory->id, $crudUser->id]);

        //$admin->permissions()->detach([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory, $crudUser]);
        //$admin->permissions()->attach([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory, $crudUser]);

        $editor->permissions()->detach([$crudPost->id, $updateOthersPost->id, $deleteOthersPost->id, $crudCategory->id]);
        $editor->permissions()->attach([$crudPost->id, $updateOthersPost->id, $deleteOthersPost->id, $crudCategory->id]);

        //$editor->permissions()->detach([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory]);
        //$editor->permissions()->attach([$crudPost, $updateOthersPost, $deleteOthersPost, $crudCategory]);

         $author->permissions()->detach($crudPost->id);
         $author->permissions()->attach($crudPost->id);
   
        //$author->permissions()->detach($crudPost);
        //$author->permissions()->attach($crudPost);
    }
}
