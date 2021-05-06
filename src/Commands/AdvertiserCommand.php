<?php

namespace Iyngaran\Advertiser\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdvertiserCommand extends Command
{
    public $signature = 'iynga:resize-post-images';

    public $description = 'This command will resize all the post images.';

    public function resizePostImages(): bool
    {
        try {
            $image_path = storage_path('app/public'.config('classified-advertiser.post_image_path'));
            $files = Storage::disk('public')->files(config('classified-advertiser.post_image_path'));
            $image_sizes = config('classified-advertiser.image_sizes');
            $bar = $this->output->createProgressBar(count($files));
            $bar->start();
            if ($files) {
                foreach ($files as $file) {
                    $file_parts = pathinfo($file);
                    if (isset($file_parts['extension']) &&
                        (
                            $file_parts['extension'] == "jpg"
                            || $file_parts['extension'] == "jpeg"
                            || $file_parts['extension'] == "png"
                            || $file_parts['extension'] == "gif"
                            || $file_parts['extension'] == "webp"
                        )
                    ) {
                        $file_name = basename($file);
                        if ($image_sizes) {
                            foreach ($image_sizes as $key => $image_size) {
                                if (!File::exists($image_path.$key)) {
                                    File::makeDirectory($image_path.$key);
                                }
                                Image::make($image_path.$file_name)
                                    ->resize($image_size['width'], $image_size['height'], function ($constraint) {
                                        $constraint->aspectRatio();
                                        $constraint->upsize();
                                    })
                                    ->save($image_path.$key.'/'.$file_name);
                            }
                        }
                        $bar->advance();
                    }
                }
            }
            $bar->finish();
            return true;
        } catch (\Exception $exception) {
            $this->error("\n".$exception->getMessage());
            return false;
        }
    }

    public function handle()
    {
        $this->info("Started. Please wait...");
        if ($this->resizePostImages()) {
            return $this->info("\n".'All the post images have been resized successfully!');
        }
        return $this->error("\n".'Failed to resize some post images!');
    }
}
