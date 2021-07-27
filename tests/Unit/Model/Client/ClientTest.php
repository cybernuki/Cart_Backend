<?php

namespace Tests\Unit\Model\Client;

use App\Model\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @group Model.Client
 */
class ClientTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group Model.Client.testCreation
     */
    public function testCreation()
    {
        $client = factory(Client::class)->create();

        $this->assertNotNull($client->cart);
    }
}
