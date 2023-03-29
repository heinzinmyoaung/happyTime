<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'product_name' => fake()->name(),
            'product_description' => fake()->lastName(),
            'product_image' => fake()->image('public/images', 400, 300, null, false),
            'product_price' => fake()->numberBetween(5, 30),
            // 'category_id' => 1
        ];
    }
}
