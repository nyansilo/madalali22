<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Admin;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        // Create Admin role
        $admin = new Role();
        $admin->name = "admin";
        $admin->slug = "admin";
        $admin->display_name = "Admin";
        $admin->save();

        // Create Editor role
        $editor = new Role();
        $editor->name = "editor";
        $editor->slug = "editor";
        $editor->display_name = "Editor";
        $editor->save();

        // Create Author role
        $author = new Role();
        $author->name = "author";
        $author->slug = "author";

        $author->display_name = "Author";
        $author->save();

        // Attach the rolesf
        // first user as admin
        $user1 = Admin::find(1);
        $user1->roles()->detach($admin);
        $user1->roles()->attach($admin);

        // second user as editor
        $user2 = Admin::find(2);
        $user2->roles()->detach($editor);
        $user2->roles()->attach($editor);

        // third user as author
        $user3 = Admin::find(3);
        $user3->roles()->detach($author);
        $user3->roles()->attach($author);
    }
}
