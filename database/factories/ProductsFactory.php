<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoriesIds = Category::pluck('id')->toArray();
        return [
            'name' => fake()->name,
            'slug' => fake()->slug,
            'price' => fake()->randomFloat(2, 1, 100),
            'image' => 'Images/Product/product-default.png',
            'description' => fake()->paragraph,
            'category_id' => fake()->randomElement($categoriesIds),
        ];
    }
}
