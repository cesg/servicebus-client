# Laravel Azure ServiceBus Guzzle Client

Provide a Guzzle client for Azure Service Bus REST api using SAS token

## Install

```bash
composer install cesg/servicebus-client
```

## Config

config/services.php

```php
[
    'servicebus' => [
        'namespace' => env('SERVICEBUS_NAMESPACE', 'test'),
        'sas_name' => env('SERVICEBUS_SAS_NAME', 'test_key'),
        'sas_key' => env('SERVICEBUS_SAS_KEY', 'test_key_value'),
    ]
]
```
