<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product;
use App\Database\Models\Product\Variation;

class VariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_variation' => $this->faker->word,
            'product_id' => Product::factory(),
        ];
    }
}
