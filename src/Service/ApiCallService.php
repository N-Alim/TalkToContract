<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Response\TraceableResponse;

class ApiCallService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function checkRequestResponse(string $urlRequest, TraceableResponse $response) : array
    {
        if ($response->getStatusCode() === 200)
        {
            return $response->toArray();    
        }

        else
        {
            echo "Un problème est survenu lors de la requête\n" 
            . "Url : " . $urlRequest . "\n" 
            . "Code de status : " . $response->getStatusCode() . "\n";
            return [];
        }
    }

    public function getAllDepartments(): array
    {
        $urlRequest = 'https://geo.api.gouv.fr/departements';
        $response = $this->client->request(
            'GET',
            $urlRequest,
        );

        return $this->checkRequestResponse($urlRequest, $response);
    }

    public function callRomeApi(string $urlRequest): array
    {
        $urlAuthRequest = 'https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=/partenaire';
        $authResponse = $this->client->request(
            'POST',
            $urlAuthRequest, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => 'PAR_talktocontract_967fd07eda2571aa091a199422cb47bf5307e253bbc09aa91d794601380f4fef',
                    'client_secret' => 'acd9333db97a47705ce848111853c3b029e5bacc7298a2aa6a13ae2ad28a3370',
                    'scope' => 'application_PAR_talktocontract_967fd07eda2571aa091a199422cb47bf5307e253bbc09aa91d794601380f4fef api_romev1 nomenclatureRome'
                ]
            ]
        );

        $authResponseArray = $this->checkRequestResponse($urlAuthRequest, $authResponse);

        if (count($authResponseArray) !== 0)
        {
            $response = $this->client->request(
                'GET',
                $urlRequest, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $authResponseArray["access_token"],
                    ],
                ]
            );
    
            return $this->checkRequestResponse($urlRequest, $response);
        }   

        else
        {
            return [];
        }
    }

    public function getAllJobsCategories(): array
    {
        return $this->callRomeApi('https://api.emploi-store.fr/partenaire/rome/v1/racinecompetence');
    }

    public function getAllJobsSubCategories(): array
    {
        return $this->callRomeApi('https://api.emploi-store.fr/partenaire/rome/v1/noeudcompetence');
    }

    public function getAllJobsSkills(): array
    {
        return $this->callRomeApi('https://api.emploi-store.fr/partenaire/rome/v1/competence');
    }
}

