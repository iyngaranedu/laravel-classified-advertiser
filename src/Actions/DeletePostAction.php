<?php


namespace Iyngaran\Advertiser\Actions;

use Iyngaran\Advertiser\Models\Post;

class DeletePostAction
{
    public function execute(Post $post): ?bool
    {
        return $post->delete();
    }
}
