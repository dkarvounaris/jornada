<?php

namespace Database\Factories\Product\Inventory;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product\Inventory\State;
use App\Database\Models\Product\Product/Inventory;
use App\Database\Models\Supplier\Supplier/Product;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inventory_id' => Product/Inventory::factory(),
            'supply_id' => Product/Inventory::factory(),
            'live_supplier_product_id' => Supplier/Product::factory(),
            'is_active' => $this->faker->word,
            'is_blocked' => $this->faker->word,
            'is_live' => $this->faker->word,
            'is_published' => $this->faker->word,
        ];
    }
}
