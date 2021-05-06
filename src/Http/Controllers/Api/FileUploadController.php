<?php


namespace Iyngaran\Advertiser\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUploadController extends Controller
{
    protected $destination_path = '/storage/';

    public function __invoke(Request $request)
    {
        try {
            $file = $request->file('file');
            $file_name = trim(str_replace(" ", "_", $file->getClientOriginalName()));
            Storage::disk('public')->put(config('classified-advertiser.post_image_path').$file_name, File::get($file));
            $img = Image::make(config('classified-advertiser.post_image_path').$file_name, File::get($file))->resize(300, 200);
            Storage::disk('public')->put(config('classified-advertiser.post_image_path').'resized-'.$file_name, $img);
        } catch (\Exception $e) {
            return response(['errors' => ['message' => $e->getMessage()]], 404);
        }

        return response()->json([
            'path' => $file_name,
            'message' => 'Successfully updated event media!',
        ], 200);
    }
}
