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

    public function callRomeApi(string $urlRequest): array
    {
        $authResponse = $this->client->request(
            'POST',
            'https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=/partenaire', [
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

        $response = $this->client->request(
            'GET',
            $urlRequest, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $authResponse->toArray()["access_token"],
                ],
            ]
        );

        return $response->toArray();
    }

    public function getAllJobsCategories(): array
    {
        // url à changer
        return $this->callRomeApi('https://api.emploi-store.fr/partenaire/rome/v1/competence');
    }

    public function getAllJobsSkills(): array
    {
        return $this->callRomeApi('https://api.emploi-store.fr/partenaire/rome/v1/competence');
    }
}

// Vérifier les urls à appeler, le nombre de valeurs à récupérer, mettre en place l'autocomplétion, 
// vérifier avec antoine si le fichier est bon et si les valeurs pour les appels de l'api rome ne sont pas à externaliser
