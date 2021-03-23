<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Http\Requests\PublicPostIndexRequest;
use Iyngaran\Advertiser\Http\Requests\PublicPostShowRequest;
use Iyngaran\Advertiser\Http\Resources\Post;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;

class FeaturedPostController extends Controller
{
    public function __invoke(
        PublicPostIndexRequest $request,
        PostRepositoryInterface $post
    ): AnonymousResourceCollection {
        $request->merge([
            'featured' => 1
        ]);
        return Post::collection($post->search($request)->shuffle());
    }
}
