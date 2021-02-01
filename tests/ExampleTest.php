<?php

namespace Iyngaran\Advertiser\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function true_is_true()
    {
        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!'
        ]));

        $category = \Iyngaran\Category\Models\Category::create([
            'name' => ucfirst($this->faker->word),
            'status' => (string)$this->faker->randomElement([0,1]),
            'image' => $this->faker->word.".png",
            'small_description' => $this->faker->sentence(10),
            'detail_description' => $this->faker->paragraph(3)
        ]);

        $sub_category = \Iyngaran\Category\Models\Category::create([
            'name' => ucfirst($this->faker->word),
            'status' => (string)$this->faker->randomElement([0,1]),
            'image' => $this->faker->word.".png",
            'small_description' => $this->faker->sentence(10),
            'detail_description' => $this->faker->paragraph(3),
            'parent_id' => $category->id
        ]);

        $response = $this->post('api/post/store',
            [
                'title' => $this->faker->text(150),
                'for' => 'sale',
                'condition' => 1,
                'short_description' => null,
                'detail_description' => null,
                'price' => $this->faker->randomFloat(2),
                'currency' => $this->faker->currencyCode,
                'negotiable' => 1,
                'category' => $category->id,
                'sub_category' => $sub_category->id,
                'status' => 'Published'
            ]
        );
        $response->assertStatus(201);
    }
}
