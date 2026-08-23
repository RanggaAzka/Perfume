<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'short_description' => fake()->sentence(10),
            'description' => fake()->paragraphs(3, true),
            'fragrance_family' => fake()->randomElement(['Warm / Elegant', 'Fresh / Modern', 'Woody / Earthy']),
            'category' => 'Eau de Parfum',
            'longevity' => '6-8 hours',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
