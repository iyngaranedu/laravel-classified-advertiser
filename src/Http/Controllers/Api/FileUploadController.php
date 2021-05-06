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
            $image_path = storage_path('app/public'.config('classified-advertiser.post_image_path'));
            $image_sizes = config('classified-advertiser.image_sizes');
            if ($image_sizes) {
                foreach ($image_sizes as $key => $image_size) {
                    if(!File::exists($image_path.$key)) {
                        File::makeDirectory($image_path.$key);
                    }
                    $img = Image::make($image_path.$file_name)->resize($image_size['width'], $image_size['height']);
                    $img->save($image_path.$key.'/'.$file_name);
                }
            }
        } catch (\Exception $e) {
            return response(['errors' => ['message' => $e->getMessage()]], 404);
        }

        return response()->json([
            'path' => $file_name,
            'message' => 'Successfully updated event media!',
        ], 200);
    }
}
