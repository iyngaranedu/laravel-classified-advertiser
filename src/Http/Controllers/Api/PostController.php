<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Actions\CreatePostAction;
use Iyngaran\Advertiser\Actions\UpdatePostAction;
use Iyngaran\Advertiser\DTO\PostData;
use Iyngaran\Advertiser\Http\Requests\PostRequest;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function store(PostRequest $request): JsonResponse
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

    public function update(PostRequest $request): JsonResponse
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
}
