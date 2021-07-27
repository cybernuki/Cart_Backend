<?php

namespace Tests\Feature\Api\V1\Client;

use App\Model\Client;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @group Api.V1.Client.ClientControllerTest
 */
class ClientControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group Api.V1.Client.ClientControllerTest.testCreate
     */
    public function testCreate()
    {
        $response = $this->post('/api/v1/clients', []);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/clients', [
            'name' => 'jhon',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/clients', [
            'name' => 'jhon',
            'last_name' => 'snow',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/clients', [
            'name' => 'jhon',
            'last_name' => 'snow',
            'document' => '12412312',
            'status' => 'non a status',
        ]);
        $response->assertStatus(422);

        $response = $this->post('/api/v1/clients', [
            'name' => 'jhon',
            'last_name' => 'snow',
            'document' => '12412312',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'uuid' => $response->json('data.uuid'),
                    'name' => 'jhon',
                    'last_name' => 'snow',
                    'document' => '12412312',
                    'status' => Client::STATUS_PENDING,
                ],
            ])
        ;
        $this->assertNotNull(Client::find($response->json('data.id')));

        $response = $this->post('/api/v1/clients', [
            'name' => 'jhon',
            'last_name' => 'snow',
            'document' => '12412312',
            'status' => Client::STATUS_ENABLED,
        ]);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => 2,
                    'uuid' => $response->json('data.uuid'),
                    'name' => 'jhon',
                    'last_name' => 'snow',
                    'document' => '12412312',
                    'status' => Client::STATUS_ENABLED,
                ],
            ])
        ;

        $this->assertNotNull(Client::find($response->json('data.id')));
    }

    /**
     * @group Api.V1.Client.ClientControllerTest.testUpdate
     */
    public function testUpdate()
    {
        $client = factory(Client::class)->create();
        $response = $this->patch("/api/v1/clients/{$client->id}", []);
        $response->assertStatus(200);

        $response = $this->patch("/api/v1/clients/{$client->id}", [
            'name' => 'jhon 1',
            'last_name' => 'snow 2',
            'document' => '12412312 3',
            'status' => 'non a enum',
        ]);
        $response->assertStatus(422);

        $response = $this->patch("/api/v1/clients/{$client->id}", [
            'name' => 'jhon 1',
            'last_name' => 'snow 2',
            'document' => '12412312 3',
            'status' => Client::STATUS_ENABLED,
        ]);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'jhon 1',
                    'last_name' => 'snow 2',
                    'document' => '12412312 3',
                    'status' => Client::STATUS_ENABLED,
                ],
            ])
        ;
    }

    /**
     * @group Api.V1.Client.ClientControllerTest.testShow
     */
    public function testShow()
    {
        $client = factory(Client::class)->create();
        $response = $this->get("/api/v1/clients/{$client->id}");
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $client->id,
                    'uuid' => $client->uuid,
                    'name' => $client->name,
                    'last_name' => $client->last_name,
                    'document' => $client->document,
                    'status' => Client::STATUS_PENDING,
                ],
            ])
        ;

        $response = $this->get('/api/v1/clients/14123');
        $response->assertStatus(404);
    }

    /**
     * @group Api.V1.Client.ClientControllerTest.testIndex
     */
    public function testIndex()
    {
        factory(Client::class, 10)->create();
        $response = $this->get('/api/v1/clients');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    0 => [
                        'id',
                        'uuid',
                        'name',
                        'last_name',
                        'document',
                        'status',
                    ],
                ],
            ])
            ->assertJsonCount(10, 'data')
        ;
    }
}
