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
            'company' => $this->faker->company(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'email' => $this->faker->companyEmail(),
            'location' => $this->faker->city(),
            'website' => $this->faker->url(),
            'tags' => 'laravel,api,backend',
        ];
    }
}
