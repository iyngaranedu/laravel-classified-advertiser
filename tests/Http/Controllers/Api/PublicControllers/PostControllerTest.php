<?php


namespace Iyngaran\Advertiser\Tests\Http\Controllers\Api\PublicControllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function posts_can_be_retrieve()
    {
        $this->withoutExceptionHandling();
        Post::factory()->count(35)->create();

        $response = $this->get('api/app/public/posts?page=2&order-by=title&order-in=ASC');
        $response->assertStatus(200);
    }

    /** @test */
    public function a_post_can_be_retrieve()
    {
        $post = Post::factory()->create();
        $response = $this->get('api/app/public/posts/'.$post->id);
        $response->assertStatus(200);
    }

}
