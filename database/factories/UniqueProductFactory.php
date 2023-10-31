<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Brand;
use App\Database\Models\ProductEanList;
use App\Database\Models\ProductMpnList;
use App\Database\Models\UniqueProduct;

class UniqueProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UniqueProduct::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_unique_by_brand_mpn' => $this->faker->word,
            'brand_id' => Brand::factory(),
            'mpn' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'ean' => $this->faker->regexify('[A-Za-z0-9]{13}'),
            'mpn_list' => ProductMpnList::factory()->create()->mpn_list,
            'ean_list' => ProductEanList::factory()->create()->ean_list,
        ];
    }
}
