<?php

namespace Cesg\ServiceBus;

use Cesg\ServiceBus\Client\ServiceBusSasClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

class ServiceBusServiceProvider extends ServiceProvider
{
    protected $tokenTtl = 60*60*24;

    public function register()
    {
        $this->app->singleton(ServiceBusSasClient::class, function (Application $app) {
            $config = $app['config']->get('services.servicebus');
            $namespace = Arr::get($config, 'namespace');
            $keyName = Arr::get($config, 'sas_name');
            $keValue = Arr::get($config, 'sas_key');
            $token = $app['cache']->get('servicebus_sas_token');

            if (empty($token)) {
                $token = $this->generateSasToken(
                    Arr::get($config, 'url', "https://{$namespace}.servicebus.windows.net"),
                    $keyName,
                    $keValue
                );

                $app['cache']->put('servicebus_sas_token', $token, $this->tokenTtl);
            }


            return new ServiceBusSasClient(
                [
                    'base_uri' => "https://{$namespace}.servicebus.windows.net",
                    'headers' => [
                        'Authorization' => "SharedAccessSignature {$token}",
                        'Accept' => 'application/json',
                    ],
                ]
            );
        });
    }

    protected function generateSasToken(string $uri, string $sasKeyName, string $sasKeyValue): string
    {
        $targetUri = strtolower(rawurlencode(strtolower($uri)));
        $expires = time();
        $expires = $expires + $this->tokenTtl;
        $toSign = $targetUri . "\n" . $expires;
        $signature = rawurlencode(base64_encode(hash_hmac(
            'sha256',
            $toSign,
            $sasKeyValue,
            true
        )));

        return "sr={$targetUri}&sig={$signature}&se={$expires}&skn={$sasKeyName}";
    }
}
