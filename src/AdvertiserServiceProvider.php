<?php

namespace Iyngaran\Advertiser;

use Illuminate\Support\Facades\Route;
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

        $this->registerWebRoutes();
        $this->registerApiRoutes();
    }

    private function registerWebRoutes()
    {
        Route::group(
            [
                'prefix' => "/",
                'middleware' => "web",
                'namespace' => 'Iyngaran\Advertiser\Http\Controllers',
            ],
            function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            }
        );
    }

    private function registerApiRoutes()
    {
        Route::group(
            [
                'prefix' => "/api/",
                'middleware' => "api",
                'namespace' => 'Iyngaran\Advertiser\Http\Controllers\Api',
            ],
            function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
            }
        );
    }
}
