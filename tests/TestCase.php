<?php

namespace Cesg\ServiceBus\Tests;

use Cesg\ServiceBus\ServiceBusServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceBusServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('services.servicebus', [
            'namespace' => env('SERVICEBUS_NAMESPACE', 'test'),
            'sas_name' => env('SERVICEBUS_SAS_NAME', 'test_key'),
            'sas_key' => env('SERVICEBUS_SAS_KEY', 'test_key_value'),
        ]);
    }
}
