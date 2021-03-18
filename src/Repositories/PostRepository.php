<?php


namespace Iyngaran\Advertiser\Repositories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Iyngaran\Advertiser\Exceptions\PostNotFoundException;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Search\SearchPost;

class PostRepository implements PostRepositoryInterface
{
    public function find(int $id): Post
    {
        if ($post = Post::find($id)) {
            return $post;
        }

        throw new PostNotFoundException("The post does not exist");
    }

    public function search(FormRequest $request): ?LengthAwarePaginator
    {
        $page_limit = config('classified-advertiser.defaults.per-page', 20);

        return (new SearchPost())->getPaginatedResults($request, $page_limit);
    }
}
