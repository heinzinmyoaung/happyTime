<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orderdetail>
 */
class OrderdetailFactory extends Factory
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
            'orderdetails_quantity' => fake()->numberBetween(1, 5),
            'orderdetails_totalprice' => fake()->numberBetween(100, 500),
        ];
    }
}
