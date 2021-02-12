<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Actions\CreatePostAction;
use Iyngaran\Advertiser\Actions\DeletePostAction;
use Iyngaran\Advertiser\Actions\UpdatePostAction;
use Iyngaran\Advertiser\DTO\PostData;
use Iyngaran\Advertiser\Http\Requests\PostDestroyRequest;
use Iyngaran\Advertiser\Http\Requests\PostStoreRequest;
use Illuminate\Http\JsonResponse;
use Iyngaran\Advertiser\Http\Requests\PostUpdateRequest;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;

class PostController extends Controller
{
    public function store(PostStoreRequest $request): JsonResponse
    {
        try {
            return response()->json(
                (new CreatePostAction())
                    ->execute(PostData::formRequest($request)),
                201
            );
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function update(PostUpdateRequest $request, PostRepositoryInterface $post, $id): JsonResponse
    {
        try {
            return response()->json(
                (new UpdatePostAction())
                    ->execute(PostData::formRequest($request), $post->find($id)),
                200
            );
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function destroy(PostDestroyRequest $request, PostRepositoryInterface $post, $id): JsonResponse
    {
        try {
            return response()->json((new DeletePostAction())->execute($post->find($id)), 204);
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }
}
