<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,    //  User::factory()
            'category_id' => rand(1, 5),
            'title' => fake()->text(15),
            'short_content' => fake()->sentence(15),
            'content' => fake()->paragraph(25)
        ];
    }
}
