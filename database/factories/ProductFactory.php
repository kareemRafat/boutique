<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name() ,
            'price' => fake()->randomNumber(5, true) ,
            'stock' => 0,
            'description' => fake()->sentence(15) ,
            'cat_id' => fake()->numberBetween(1,3)
        ];
    }
}


