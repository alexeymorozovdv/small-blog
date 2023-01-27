<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $i = 0;
        $name = ucfirst($this->faker->word());
        $i++;

        return [
            'name' => $name,
            'parent_id' => $i > 3 ? rand(1, 3) : 0,
            'content' => $this->faker->realText(rand(200, 500)),
            'slug' => Str::slug($name),
        ];
    }
}
