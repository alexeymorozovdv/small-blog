<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['slug' => 'manage-users', 'name' => 'User Management'],
            ['slug' => 'create-user', 'name' => 'User Creation Management'],
            ['slug' => 'edit-user', 'name' => 'Edit a User'],
            ['slug' => 'delete-user', 'name' => 'Delete a User'],

            ['slug' => 'manage-roles', 'name' => 'Roles Management'],
            ['slug' => 'create-role', 'name' => 'Create a Role'],
            ['slug' => 'edit-role', 'name' => 'Edit a Role'],
            ['slug' => 'delete-role', 'name' => 'Delete a Role'],

            ['slug' => 'assign-role', 'name' => 'Assign a Role'],
            ['slug' => 'assign-permission', 'name' => 'Assign a Permission'],

            ['slug' => 'manage-posts', 'name' => 'Posts Management'],
            ['slug' => 'create-post', 'name' => 'Create a Post'],
            ['slug' => 'edit-post', 'name' => 'Edit a post'],
            ['slug' => 'publish-post', 'name' => 'Publish a Post'],
            ['slug' => 'delete-post', 'name' => 'Delete a Post'],

            ['slug' => 'manage-categories', 'name' => 'Categories Management'],
            ['slug' => 'create-category', 'name' => 'Create a Category'],
            ['slug' => 'edit-category', 'name' => 'Edit a Category'],
            ['slug' => 'delete-category', 'name' => 'Delete a Category'],

            ['slug' => 'manage-comments', 'name' => 'Comments Management'],
            ['slug' => 'create-comment', 'name' => 'Create a Comment'],
            ['slug' => 'edit-comment', 'name' => 'Edit a Comment'],
            ['slug' => 'publish-comment', 'name' => 'Publish a Comment'],
            ['slug' => 'delete-comment', 'name' => 'Delete a Comment'],
        ];

        foreach ($permissions as $item) {
            $permission = new Permission();
            $permission->name = $item['name'];
            $permission->slug = $item['slug'];
            $permission->save();
        }
    }
}
