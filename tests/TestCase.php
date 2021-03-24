<?php

namespace Iyngaran\Advertiser\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Iyngaran\Advertiser\AdvertiserServiceProvider;
use Iyngaran\Category\CategoryServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Iyngaran\\Advertiser\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AdvertiserServiceProvider::class,
            CategoryServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);


        include_once __DIR__.'/../vendor/iyngaran/laravel-categories/database/migrations/create_laravel_categories_table.php.stub';
        (new \CreateLaravelCategoriesTable())->up();

        include_once __DIR__.'/../vendor/iyngaran/laravel-locations/database/migrations/create_laravel_locations_table.php.stub';
        (new \CreateLaravelLocationsTable())->up();

        include_once __DIR__.'/../database/migrations/create_laravel_classified_advertiser_table.php.stub';
        (new \CreateLaravelClassifiedAdvertiserTable())->up();

        include_once __DIR__.'/../tests/migrations/2014_10_12_000000_create_test_tables.php';
        (new \CreateTestTable())->up();
    }
}
