<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Http\Requests\PublicPostShowRequest;
use Iyngaran\Advertiser\Http\Requests\PublicPostIndexRequest;
use Iyngaran\Advertiser\Http\Resources\Post;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;

class PostController extends Controller
{
    public function index(PublicPostIndexRequest $request, PostRepositoryInterface $post): AnonymousResourceCollection
    {
        return Post::collection($post->search($request));
    }

    public function show(PublicPostShowRequest $request, PostRepositoryInterface $post, $id): JsonResponse
    {
        return response()->json(new Post($post->find($id)));
    }
}
