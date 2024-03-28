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
            'company_id' => $this->faker->numberBetween( $min = 1, $max = 4 ),
            'product_name' => $this->faker->realText( 10 ),
            'img_path' => $this->faker->realText( 20 ),
            'price' => $this->faker->numberBetween( $min = 100, $max = 199 ),
            'stock' => $this->faker->numberBetween( $min = 1, $max = 99 ),
            'comment' => $this->faker->realText( 20 ),
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => null,
        ];
    }
}
