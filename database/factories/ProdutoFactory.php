<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'identification_number' => $this->faker->unique()->numberBetween(1, 50),
            'name' => fake()->name(),
            'price' => '10.00',
            'quantity' => 50,
            'qt_vendas' => 0,
        ];
    }
}
