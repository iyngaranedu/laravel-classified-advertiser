<?php

namespace Iyngaran\Advertiser\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Iyngaran\Advertiser\Models\Category;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Tests\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function true_is_true()
    {
        $category = Category::factory()
            ->child()
            ->create();


        $post = Post::factory()
            ->published()
            ->reviewed()
            ->create();


        auth()->login(User::create([
            'name' => 'Iyngaran',
            'email' => 'Iyngaran55@yahoo.com',
            'password' => 'password!',
        ]));

        $this->assertTrue(true);
    }
}
