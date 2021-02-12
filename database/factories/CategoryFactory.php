<?php


namespace Iyngaran\Advertiser\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Iyngaran\Advertiser\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->word),
            'status' => (string)$this->faker->randomElement([0,1]),
            'image' => $this->faker->word.".png",
            'small_description' => $this->faker->sentence(10),
            'detail_description' => $this->faker->paragraph(3)
        ];
    }

    public function child(): CategoryFactory
    {
        return $this->state([
            'parent_id' => Category::factory()->create()
        ]);
    }
}
