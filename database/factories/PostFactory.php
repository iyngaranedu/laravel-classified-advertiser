<?php

namespace Iyngaran\Advertiser\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Iyngaran\Advertiser\Models\Category;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\Models\User;


class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = ucfirst($this->faker->sentence);
        return [
            'title' => ucfirst($this->faker->sentence),
            'slug' => Str::slug($title),
            'for' => $this->faker->randomElement([Post::FOR_RENT, Post::FOR_SALE]),
            'condition' => $this->faker->randomElement([Post::CONDITION_NEW, Post::CONDITION_USED]),
            'short_description' => $this->faker->paragraph(2),
            'detail_description' => $this->faker->paragraph(5),
            'price' => $this->faker->randomFloat(2),
            'currency' => 'EUR',
            'negotiable' => $this->faker->randomElement([0, 1]),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'geo_location' => [
                'lat' => $this->faker->randomFloat(2),
                'lon' => $this->faker->randomFloat(2)
            ],
            'contact_numbers' => [
                $this->faker->phoneNumber,
                $this->faker->phoneNumber
            ],
            'category_id' => Category::factory(),
            'sub_category_id' => Category::factory(),
            'belongs_to' => User::factory(),
            'posted_by' => User::factory(),
            'posted_at' => $this->faker->dateTime,
            'marked_as_featured' => $this->faker->randomElement([0,1]),
            'status' => $this->faker->randomElement(['Drafted','Pending']),
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
