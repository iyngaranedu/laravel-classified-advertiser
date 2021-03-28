<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Actions\CreatePostAction;
use Iyngaran\Advertiser\DTO\PostData;
use Iyngaran\Advertiser\Http\Requests\PostStoreRequest;
use Iyngaran\Advertiser\Http\Requests\PublicPostIndexRequest;
use Iyngaran\Advertiser\Http\Requests\PublicPostShowRequest;
use Iyngaran\Advertiser\Http\Resources\Post;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;

class PostController extends Controller
{
    public function index(PublicPostIndexRequest $request, PostRepositoryInterface $post): AnonymousResourceCollection
    {
        return Post::collection($post->search($request));
    }

    public function show(PublicPostShowRequest $request, PostRepositoryInterface $post, $slug): JsonResponse
    {
        return response()->json(new Post($post->findBySlug($slug)));
    }

    public function store(PostStoreRequest $request): JsonResponse
    {
        try {
            return response()
                ->json(
                    new Post((new CreatePostAction())
                        ->execute(PostData::formRequest($request))),
                    201
                );
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }
}
