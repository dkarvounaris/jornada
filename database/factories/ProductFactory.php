<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Brand;
use App\Database\Models\Product;
use App\Database\Models\UniqueProduct;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_product' => $this->faker->word,
            'unique_by_brand_mpn_id' => UniqueProduct::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
