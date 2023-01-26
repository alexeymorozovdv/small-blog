<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all() as $user) {
            foreach(Permission::all() as $permission) {
                if (rand(1, 20) == 10) {
                     $user->permissions()->attach($permission->id);
                }
            }
        }
    }
}
