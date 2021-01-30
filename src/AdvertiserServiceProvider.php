<?php

namespace Iyngaran\Advertiser;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Iyngaran\Advertiser\Commands\AdvertiserCommand;

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
