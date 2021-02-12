<?php


namespace Iyngaran\Advertiser\Repositories;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Iyngaran\Advertiser\Exceptions\PostNotFoundException;
use Iyngaran\Advertiser\Models\Post;
use Illuminate\Pagination\Paginator;

class PostRepository implements PostRepositoryInterface
{

    public function find(int $id): Post
    {
        if ($post = Post::find($id)) {
            return $post;
        }

        throw new PostNotFoundException("The post does not exist");
    }

    public function all(FormRequest $request): ?LengthAwarePaginator
    {
        $page = $request->input('page');
        $per_page = $request->input('per-page');
        $order_by = $request->input('order-by');
        $order_in = $request->input('order-in');

        if (! $per_page) {
            $per_page = config('classified-advertiser.defaults.per-page');
        }

        if (! $order_by) {
            $order_by = config('classified-advertiser.defaults.order-by');
        }

        if (! $order_in) {
            $order_in = config('classified-advertiser.defaults.order-in');
        }

        Paginator::currentPageResolver(
            function () use ($page) {
                return $page;
            }
        );

        return Post::orderBy($order_by, $order_in)->paginate($per_page);
    }
}
