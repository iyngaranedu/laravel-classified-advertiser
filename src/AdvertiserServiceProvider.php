<?php

namespace Iyngaran\Advertiser;

use Iyngaran\Advertiser\Commands\AdvertiserCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AdvertiserServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-classified-advertiser')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_classified_advertiser_table')
            ->hasCommand(AdvertiserCommand::class);
    }
}
