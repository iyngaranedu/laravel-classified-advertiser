<?php


namespace Iyngaran\Advertiser\Actions;

use Iyngaran\Advertiser\DTO\PostData;
use Iyngaran\Advertiser\Models\Post;

class CreatePostAction
{
    public function execute(PostData $data): Post
    {
        $post = Post::create(
            $data->except('category', 'sub_category', 'default_image', 'images')
                ->toArray()
        );

        if (! empty($data->category)) {
            $post->category()->associate($data->category)->save();
        }

        if (! empty($data->sub_category)) {
            $post->subCategory()->associate($data->sub_category)->save();
        }

        if ($data->default_image) {
            $post = (new AttachDefaultImageAction())->execute($post, $data->default_image);
        }

        if ($data->images) {
            $post = (new AttachImagesAction())->execute($post, $data->images);
        }

        return $post;
    }
}
