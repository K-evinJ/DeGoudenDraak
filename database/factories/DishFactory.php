<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DishType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (DishType::count() === 0) {
            DishType::factory()->count(5)->create();
        }
        return [
            'number' => Dish::max('number') ? Dish::max('number') + 1 : 1,
            'name' => $this->faker->words(3, true),
            // Price: decimal between 1.00 and 50.00
            'price' => $this->faker->randomFloat(2, 1, 50),
            // Description: nullable string max 300 chars
            'description' => $this->faker->optional()->text(300),
            // Visible: boolean
            'visible' => true,
            // dish_type: must exist in dish_types table; pick random type
            'dish_type' => DishType::inRandomOrder()->value('type'),
        ];
    }
}
