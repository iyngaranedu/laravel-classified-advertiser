<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Iyngaran\Advertiser\Actions\CreatePostAction;
use Iyngaran\Advertiser\DTO\PostData;
use Iyngaran\Advertiser\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function store(PostRequest $request)
    {
        try {
            return response()->json(
                (new CreatePostAction())
                    ->execute(PostData::formRequest($request)),
                201
            );
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
