<?php

namespace Database\Factories\Published\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product;
use App\Database\Models\Product\Condition;
use App\Database\Models\Product\Inventory;
use App\Database\Models\Product\Product/Description;
use App\Database\Models\Product\Shop;
use App\Database\Models\Product\Supplier;
use App\Database\Models\Product\Variation;
use App\Database\Models\Published\Product\Inventory;
use App\Database\Models\Published\Product\Shop;

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
            'inventory_id' => Product::factory(),
            'shop_id' => Shop::factory(),
            'is_published' => $this->faker->word,
            'published_at' => $this->faker->dateTime(),
            'published_first' => $this->faker->dateTime(),
            'last_stock_update' => $this->faker->dateTime(),
            'published_media_at' => $this->faker->dateTime(),
            'published_description_at' => $this->faker->dateTime(),
        ];
    }
}
