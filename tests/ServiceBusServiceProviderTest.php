<?php

namespace Cesg\ServiceBus\Tests;

use Cesg\ServiceBus\Client\ServiceBusSasClient;

class ServiceBusServiceProviderTest extends TestCase
{
    /** @test */
    public function it_provide_a_servicebus_sas_client()
    {
        /** @var \Cesg\ServiceBus\Client\ServiceBusSasClient $client */
        $client = resolve(ServiceBusSasClient::class);

        $this->assertNotNull($client);
        $this->assertTrue($client instanceof ServiceBusSasClient);
    }
}
