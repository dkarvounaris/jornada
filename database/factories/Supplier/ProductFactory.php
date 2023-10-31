<?php

namespace Database\Factories\Supplier;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Brand;
use App\Database\Models\Product;
use App\Database\Models\Supplier\Product;
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
            'product_id' => Product::factory(),
        ];
    }
}
