<?php

namespace Database\Factories\Published\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product;
use App\Database\Models\Product\Attachment;
use App\Database\Models\Product\Media;
use App\Database\Models\Published\Product\Media;
use App\Database\Models\Published\Product\Shop;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'media_id' => Product::factory(),
            'shop_id' => Shop::factory(),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
