<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(100,300),
            'stock' => $this->faker->numberBetween(1,10),
            'category_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
