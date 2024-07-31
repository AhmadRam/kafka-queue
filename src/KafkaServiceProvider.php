<?php

namespace Ahmadramadan\KafkaQueue;

use Illuminate\Support\ServiceProvider;

class KafkaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $manager = $this->app->make('queue');

        $manager->addConnector('kafka', function () {
            return new KafkaConnector;
        });
    }
}
