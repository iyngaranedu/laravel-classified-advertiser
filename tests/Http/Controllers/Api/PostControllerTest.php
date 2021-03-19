<?php


namespace Iyngaran\Advertiser\Tests\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
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
            'for' => $this->faker->randomElement(['sale', 'rent']),
            'condition' => $this->faker->randomElement([1, 2]),
            'short_description' => $this->faker->paragraph,
            'detail_description' => $this->faker->paragraph(5),
            'price' => $this->faker->randomFloat(2),
            'currency' => $this->faker->currencyCode,
            'negotiable' => $this->faker->randomElement([0, 1]),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'geo_location' => [
                'lat' => $this->faker->randomFloat(5),
                'lon' => $this->faker->randomFloat(5),
            ],

            'contact_numbers' => [
                $this->faker->randomFloat(5),
                $this->faker->randomFloat(5),
            ],

            'category' => $category->id,
            'sub_category' => $sub_category->id,
            'default_image' => [
                'url' => Str::slug($this->faker->word).".png"
            ],
            'images' => [
                [
                    'url' => Str::slug($this->faker->word).".png",
                    'display_order' => 1
                ],
                [
                    'url' => Str::slug($this->faker->word).".png",
                    'display_order' => 2
                ],
                [
                    'url' => Str::slug($this->faker->word).".png",
                    'display_order' => 3
                ],
            ],
            'status' => 'Published',
        ];
    }

    /** @test */
    public function posts_can_be_retrieve()
    {
        $this->withoutExceptionHandling();
        Post::factory()->count(35)->create();

        $response = $this->get('api/app/posts?page=2&order-by=title&order-in=ASC');
        $response->assertStatus(200);
    }

    /** @test */
    public function a_post_can_be_retrieve()
    {
        $post = Post::factory()->create();
        $response = $this->get('api/app/posts/'.$post->id);
        $response->assertStatus(200);
    }

    /** @test */
    public function a_post_can_be_created()
    {
        $this->withoutExceptionHandling();
        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]));

        $response = $this->post(
            'api/app/posts',
            $this->mockPostData()
        );
        $response->assertStatus(201);
    }

    /** @test */
    public function a_post_can_be_updated()
    {
        $this->withoutExceptionHandling();
        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]));

        $post = Post::factory()->create();

        $response = $this->put(
            'api/app/posts/'.$post->id,
            $this->mockPostData()
        );
        $response->assertStatus(200);
    }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $post = Post::factory()->create();
        $response = $this->delete('api/app/posts/'.$post->id);
        $this->assertEquals(0, Post::all()->count());
        $response->assertStatus(204);
    }

    /** @test */
    public function a_post_can_be_updated_with_review_status()
    {
        $this->withoutExceptionHandling();
        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]));

        $post = Post::factory()->create();

        $postData = $this->mockPostData();
        $postData['review_status'] = 'Reviewed';
        $response = $this->put(
            'api/app/posts/'.$post->id,
            $postData
        );
        $response->assertStatus(200);
    }
}
