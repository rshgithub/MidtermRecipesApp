<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'dish_id' => $this->faker->numberBetween(1,10),
            'rate' => $this->faker->numberBetween(0, 5)
        ];
    }
}
