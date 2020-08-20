<?php

declare(strict_types=1);

namespace Chanshige\HoujinBangou\Laravel;

use Chanshige\HoujinBangou\Client;
use Chanshige\HoujinBangou\Contracts\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ClientInterface::class, function () {
            return new Client(
                new GuzzleClient(),
                $this->app->make('config')['services.houjin_bangou.application_id']
            );
        });
    }

    public function provides()
    {
        return [
            ClientInterface::class
        ];
    }
}
