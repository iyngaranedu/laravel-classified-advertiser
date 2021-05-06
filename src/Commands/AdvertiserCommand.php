<?php

namespace Iyngaran\Advertiser\Commands;

use Illuminate\Console\Command;

class AdvertiserCommand extends Command
{
    public $signature = 'iynga:resize-post-images';

    public $description = 'This command will resize all the post images.';

    public function resizePostImages(): bool
    {
        try{
            $image_path = storage_path('app/public'.config('classified-advertiser.post_image_path'));
            console.log($image_path);
            return true;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }
    public function handle()
    {
        if ($this->resizePostImages()) {
            return $this->info('All the post images have been resized successfully!');
        }
        return $this->error('Failed to resize some post images!');
    }
}
