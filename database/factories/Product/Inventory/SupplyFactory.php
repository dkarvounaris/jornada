<?php

namespace Database\Factories\Product\Inventory;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product\Inventory\Shop;
use App\Database\Models\Product\Inventory\Supplier;
use App\Database\Models\Product\Inventory\Supply;
use App\Database\Models\Product\Product/Inventory;

class SupplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supply::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inventory_id' => Product/Inventory::factory(),
            'supplier_id' => Supplier::factory(),
            'shop_id' => Shop::factory(),
            'stock' => $this->faker->numberBetween(-10000, 10000),
            'cost' => $this->faker->word,
            'price' => $this->faker->word,
            'shipping' => $this->faker->word,
        ];
    }
}
