<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement([1, 2]),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(5),
            'email' => fake()->email(),
            'tags' => fake()->randomElement([
                'dev,game',
                'dev,web',
                'biz,tech',
            ]),
            'link' => fake()->url(),
            'approved' => 1,
        ];
    }
}
