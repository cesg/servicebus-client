<?php

namespace Cesg\ServiceBus\Client;

use GuzzleHttp\Client;

class ServiceBusSasClient extends Client
{
    public function __construct(array $config)
    {
        parent::__construct($config);
    }
}
