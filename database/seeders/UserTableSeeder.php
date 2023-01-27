<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'q@q.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Test123123'),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRoles('root');
        $allPermissions = Permission::all()->pluck('slug')->toArray();
        foreach ($allPermissions as $permission) {
            $user->assignRoles('super-admin')->assignPermissions($permission);
        }

        $user->save();
    }
}
