<?php

namespace Iyngaran\Advertiser\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Iyngaran\Advertiser\AdvertiserServiceProvider;
use Iyngaran\Category\CategoryBaseServiceProvider;
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
            CategoryBaseServiceProvider::class,
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


        include_once __DIR__.'/../database/migrations/create_laravel_classified_advertiser_table.php.stub';
        (new \CreateAdvertiserTable())->up();

        include_once __DIR__.'/../tests/migrations/2014_10_12_000000_create_test_tables.php';
        (new \CreateTestTable())->up();
    }
}
