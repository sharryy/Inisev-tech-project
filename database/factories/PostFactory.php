<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
            'websites_website_id' => Website::factory(),
            'title'               => fake()->sentence(),
            'slug'                => fake()->slug(),
            'content'             => fake()->paragraph(),
        ];
    }
}
