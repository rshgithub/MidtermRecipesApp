<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, // 3 words
            'description' => $this->faker->sentence(20), // 20 words
            'serve' => $this->faker->numberBetween(1,10),
            'preparation_time' => $this->faker->numberBetween(1,30),
            'cooking_time' => $this->faker->numberBetween(1,60),
            'image' => $this->faker->imageUrl(),
            'category_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
