<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product;
use App\Database\Models\Product\Condition;
use App\Database\Models\Product\Inventory;
use App\Database\Models\Product\Product/Description;
use App\Database\Models\Product\Shop;
use App\Database\Models\Product\Supplier;
use App\Database\Models\Product\Variation;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_inventory' => $this->faker->word,
            'shop_id' => Shop::factory(),
            'product_id' => Product::factory(),
            'condition_id' => Condition::factory(),
            'variation_id' => Variation::factory(),
            'supplier_id' => Supplier::factory(),
            'description_id' => Product/Description::factory(),
        ];
    }
}
