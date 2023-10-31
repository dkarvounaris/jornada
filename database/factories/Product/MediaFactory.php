<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Database\Models\Product;
use App\Database\Models\Product\Attachment;
use App\Database\Models\Product\Media;

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
            'id_media' => $this->faker->word,
            'product_id' => Product::factory(),
            'type' => $this->faker->word,
            'attachment_id' => Attachment::factory(),
        ];
    }
}
