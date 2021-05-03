<?php


namespace Iyngaran\Advertiser\Tests\Http\Controllers\Api\PublicControllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\TestCase;

class FeaturedPostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function featured_posts_can_be_retrieve()
    {
        $this->withoutExceptionHandling();
        Post::factory()->count(35)->create();

        $response = $this->get('api/app/public/featured-posts?page=2&order-by=title&order-in=ASC');
        $response->assertStatus(200)
            ->assertJson([
                [
                    'marked_as_featured' => 1,
                ],
            ])
            ->assertJsonStructure([
                [
                    'id',
                    'title',
                    'slug',
                    'for',
                    'condition',
                    'short_description',
                    'detail_description',
                    'price',
                    'currency',
                    'negotiable',
                    'address',
                    'city',
                    'state',
                    'country',
                    'geo_location',
                    'contact_numbers',
                    'category' => ['id', 'name'],
                    'sub_category' => ['id', 'name'],
                    'default_image',
                    'images',
                    'belongs_to' => ['id', 'name', 'email'],
                    'posted_by',
                    'posted_at',
                    'marked_as_featured',
                    'status',
                    'published_by',
                    'published_at',
                    'review_status',
                    'reviewed_by',
                    'reviewed_at',
                    'created_at',
                    'updated_at',
                    'updated_at_diff_for_humans',
                    'posted_at_diff_for_humans',
                    'published_at_diff_for_humans',
                    'reviewed_at_diff_for_humans',
                    'created_at_diff_for_humans',
                ],
            ]);
    }
}
