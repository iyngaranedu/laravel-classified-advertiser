<?php


namespace Iyngaran\Advertiser\Tests\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\Models\User;
use Iyngaran\Advertiser\Tests\TestCase;
use Iyngaran\Category\Models\Category;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function mockPostData(): array
    {
        $category = Category::create([
            'name' => ucfirst($this->faker->word),
            'status' => (string)$this->faker->randomElement([0, 1]),
            'image' => $this->faker->word.".png",
            'small_description' => $this->faker->sentence(10),
            'detail_description' => $this->faker->paragraph(3),
        ]);

        $sub_category = Category::create([
            'name' => ucfirst($this->faker->word),
            'status' => (string)$this->faker->randomElement([0, 1]),
            'image' => $this->faker->word.".png",
            'small_description' => $this->faker->sentence(10),
            'detail_description' => $this->faker->paragraph(3),
            'parent_id' => $category->id,
        ]);


        return [
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
            'status' => 'Published',
        ];
    }

    /** @test */
    public function a_post_can_be_created()
    {
        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]));

        $response = $this->post(
            'api/post',
            $this->mockPostData()
        );
        $response->assertStatus(201);
    }

    /** @test */
    public function a_post_can_be_updated()
    {
        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]));

        $post = Post::factory()->create();

        $response = $this->put(
            'api/post/'.$post->id,
            $this->mockPostData()
        );
        $response->assertStatus(200);
    }
}
