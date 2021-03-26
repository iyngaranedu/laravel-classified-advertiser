<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    protected $destination_path = '/storage/';

    public function __invoke(Request $request)
    {
        try {
            $file = $request->file('file');
            $file_name = trim(str_replace(" ", "_", $file->getClientOriginalName()));
            Storage::disk(config('classified-advertiser.post_image_path'))->put($file_name, File::get($file));
        } catch (\Exception $e) {
            return response(['errors' => ['message' => $e->getMessage()]], 404);
        }

        return response()->json([
            'path' => $file_name,
            'message' => 'Successfully updated event media!',
        ], 200);
    }
}
