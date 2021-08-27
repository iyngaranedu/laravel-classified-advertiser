<?php

namespace Iyngaran\Advertiser;

use Illuminate\Support\Facades\Route;
use Iyngaran\Advertiser\Commands\AdvertiserCommand;
use Iyngaran\Advertiser\Models\Post;
use Iyngaran\Advertiser\Observers\PostObserver;
use Iyngaran\Advertiser\Repositories\PostRepository;
use Iyngaran\Advertiser\Repositories\PostRepositoryInterface;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Intervention\Image\ImageServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

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

        $this->registerServiceProviders();
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

    private function registerServiceProviders()
    {
        $this->app->bind(ImageServiceProvider::class);
        $this->app->alias(\Intervention\Image\Facades\Image::class, 'Image');
    }

    public function boot(): self
    {
        parent::boot();
        Resource::withoutWrapping();
        Post::observe(PostObserver::class);

        return $this;
    }
}
