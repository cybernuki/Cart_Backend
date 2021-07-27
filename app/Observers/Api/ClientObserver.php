<?php

namespace App\Observers\Api;

use App\Model\Client;

class ClientObserver
{
    public function created(Client $client)
    {
        $client->cart()->create();
    }
}
