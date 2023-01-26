<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Role::all() as $role) {
            if ($role->slug == 'root') {
                foreach (Permission::all() as $permission) {
                    $role->permissions()->attach($permission->id);
                }
            }

            if ($role->slug == 'admin') {
                $slugs = [
                    'create-post', 'edit-post', 'publish-post', 'delete-post',
                    'create-comment', 'edit-comment', 'publish-comment', 'delete-comment'
                ];
                foreach ($slugs as $slug) {
                    $permission = Permission::where('slug', $slug)->first();
                    $role->permissions()->attach($permission->id);
                }
            }

            if ($role->slug == 'user') {
                $slugs = ['create-post', 'create-comment'];
                foreach ($slugs as $slug) {
                    $permission = Permission::where('slug', $slug)->first();
                    $role->permissions()->attach($permission->id);
                }
            }
        }
    }
}
