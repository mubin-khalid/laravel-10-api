<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $height = rand(101, 200);
        $width = rand(101, 200);
        return [
            'name' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'logo' =>  sprintf("https://source.unsplash.com/random/%dx%d", $width, $height),
            'website' => fake()->domainName()
        ];
    }
}
