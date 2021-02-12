<?php


namespace Iyngaran\Advertiser\Actions;

use Iyngaran\Advertiser\DTO\PostData;
use Iyngaran\Advertiser\Models\Post;

class CreatePostAction
{
    public function execute(PostData $data): Post
    {
        $post = Post::create(
            $data->except('category', 'sub_category')
                ->toArray()
        );

        if ($post) {
            if (! empty($data->category)) {
                $post->category()->associate($data->category)->save();
            }

            if (! empty($data->sub_category)) {
                $post->subCategory()->associate($data->sub_category)->save();
            }
        }

        return $post;
    }
}
