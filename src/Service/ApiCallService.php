<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiCallService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAllDepartments(): array
    {
        $response = $this->client->request(
            'GET',
            'https://geo.api.gouv.fr/departements'
        );

        return $response->toArray();
    }
}