<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Addondetail>
 */
class AddondetailFactory extends Factory
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
            'addondetail_name' => fake()->name(),
            'addondetail_price' => fake()->numberBetween(10, 50)
        ];
    }
}
