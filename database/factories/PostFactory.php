<?php

namespace Iyngaran\Advertiser\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Iyngaran\Advertiser\Models\Category;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\Models\User;


class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->sentence),
            'for' => $this->faker->randomElement([Post::FOR_RENT, Post::FOR_SALE]),
            'condition' => $this->faker->randomElement([Post::CONDITION_NEW, Post::CONDITION_USED]),
            'short_description' => $this->faker->paragraph(2),
            'detail_description' => $this->faker->paragraph(5),
            'price' => $this->faker->randomFloat(2),
            'currency' => 'EUR',
            'negotiable' => $this->faker->randomElement([0, 1]),
            'category_id' => Category::factory(),
            'sub_category_id' => Category::factory(),
            'belongs_to' => User::factory(),
            'posted_by' => User::factory(),
            'posted_at' => $this->faker->dateTime,
            'status' => $this->faker->randomElement(['Drafted', 'Pending']),
            'review_status' => $this->faker->randomElement(['In-Progress', 'Pending'])
        ];
    }

    public function published(): PostFactory
    {
        return $this->state([
            'status' => 'Published',
            'published_by' => User::factory(),
            'published_at' => $this->faker->dateTime
        ]);
    }

    public function reviewed(): PostFactory
    {
        return $this->state([
            'review_status' => 'Reviewed',
            'reviewed_by' => User::factory()
        ]);
    }
}
