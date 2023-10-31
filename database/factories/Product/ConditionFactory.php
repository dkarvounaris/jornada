<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product\Condition;
use App\Database\Models\Product\Language;

class ConditionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Condition::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_condition' => $this->faker->word,
            'language_id' => Language::factory(),
            'condition' => Condition::factory()->create()->condition,
            'description' => $this->faker->text,
        ];
    }
}
