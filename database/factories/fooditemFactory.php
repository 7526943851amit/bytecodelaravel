<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FooditemFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
 
    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
        
    }
    
}
