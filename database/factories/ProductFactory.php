<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'product_name' => $this->faker->realText( 10 ),
            'price' => $this->faker->numberBetween( $min = 100, $max = 199 ),
            'company' => $this->faker->numberBetween( $min = 1, $max = 4 ),
            'comment' => $this->faker->realText( 20 ),
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => null,
        ];
    }
}
