<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product;
use App\Database\Models\Product\Description;
use App\Database\Models\Product\Language;

class DescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Description::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'language_id' => Language::factory(),
            'name' => $this->faker->name,
            'title' => $this->faker->sentence(4),
            'short_description' => $this->faker->text,
            'description' => $this->faker->text,
            'source' => $this->faker->randomElement(/** enum_attributes **/),
        ];
    }
}
