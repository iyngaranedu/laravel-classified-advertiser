<?php

namespace Iyngaran\Advertiser\Commands;

use Illuminate\Console\Command;

class AdvertiserCommand extends Command
{
    public $signature = 'laravel-classified-advertiser';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
