<?php


namespace Iyngaran\Advertiser\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Iyngaran\Advertiser\Models\Category;
use Iyngaran\Advertiser\Models\Image;
use Iyngaran\Advertiser\Models\Post;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'imageable_id' => Post::factory(),
            'url' => $this->faker->word.".png",
            'imageable_type' => Post::class
        ];
    }
}
