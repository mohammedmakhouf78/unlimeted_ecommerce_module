<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $buy_price =fake()->randomFloat(2,100,2000);
        return [
            'buy_price' => $buy_price,
            'sell_price_trade' => $buy_price + 50,
            'sell_price_piece' => $buy_price + 100,
            'quantity' => fake()->numberBetween(1,50),
            'discount' => fake()->numberBetween(1,30)
        ];
    }
}
