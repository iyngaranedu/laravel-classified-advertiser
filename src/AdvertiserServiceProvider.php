<?php

namespace Iyngaran\Advertiser;

use Illuminate\Support\Facades\Route;
use Iyngaran\Advertiser\Commands\AdvertiserCommand;
use Iyngaran\Advertiser\Repositories\PostRepository;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;
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

        $this->registerRepositories();
        $this->registerWebRoutes();
        $this->registerApiRoutes();
    }

    private function registerWebRoutes()
    {
        Route::group(
            [
                'prefix' => "/".config('classified-advertiser.url_prefix', 'app'),
                'middleware' => "web",
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
                'prefix' => "/api/".config('classified-advertiser.url_prefix', 'app'),
                'middleware' => "api",
            ],
            function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
            }
        );
    }

    private function registerRepositories()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
