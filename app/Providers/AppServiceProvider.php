<?php

namespace App\Providers;

use App\Repositories\PropertyRepository;
use App\Repositories\PropertyRepositoryEloquent;
use App\Services\Client;
use App\Services\CliLogger;
use App\Services\SimpleClient;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        PropertyRepository::class => PropertyRepositoryEloquent::class,
        Client::class => SimpleClient::class,
        LoggerInterface::class => CliLogger::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
