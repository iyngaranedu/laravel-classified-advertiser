<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api\PublicControllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Http\Requests\PublicPostIndexRequest;
use Iyngaran\Advertiser\Http\Requests\PublicPostShowRequest;
use Iyngaran\Advertiser\Http\Resources\Post;
use Iyngaran\Advertiser\Http\Resources\PostCollection;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;

class PostController extends Controller
{
    public function index(PublicPostIndexRequest $request, PostRepositoryInterface $post): JsonResponse
    {
        return response()->json(new PostCollection($post->search($request)));
    }

    public function show(PublicPostShowRequest $request, PostRepositoryInterface $post, $slug): JsonResponse
    {
        return response()->json(new Post($post->findBySlug($slug)));
    }
}
