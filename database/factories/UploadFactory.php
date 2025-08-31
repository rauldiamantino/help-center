<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upload>
 */
class UploadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => 'images/' . rand(1, 5) . '/' . $this->faker->word . '.png',
            'company_id' => rand(1, 3),
            'owner_type' => 'App\\Models\\Article',
            'owner_id' => rand(1, 10),
        ];
    }
}
