<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Client\StoreRequest;
use App\Http\Requests\Api\V1\Client\UpdateRequest;
use App\Http\Resources\Api\V1\Client\ClientResource;
use App\Model\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     * "/api/v1/clients/".
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientResource::collection(Client::get());
    }

    /**
     * Store a newly created resource in storage.
     * "/api/v1/clients/".
     */
    public function store(StoreRequest $request)
    {
        $client = Client::create($request->all());

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     * "/api/v1/clients/{client_id}".
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     * "/api/v1/clients/{client_id}".
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Client $client)
    {
        $client->update($request->all());

        return new ClientResource($client);
    }
}
