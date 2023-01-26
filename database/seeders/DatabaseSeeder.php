<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(12)->create();
        $posts = Post::factory(50)->create();
        $tags = Tag::factory(100)->create();
        Comment::factory(200)->create();

        foreach($posts as $post) {
            foreach($tags as $tag) {
                if (rand(1, 20) == 10) {
                    $post->tags()->attach($tag->id);
                }
            }
        }

        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserPermissionTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);    }
}
