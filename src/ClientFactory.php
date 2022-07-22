<?php

namespace DoppioGancio\GitLab;

use GuzzleHttp\Client as HttpClient;

class ClientFactory
{
    static public function create(string $baseUri, string $projectID, string $token): Client
    {
        $httpClient = new HttpClient([
            'base_uri' => $baseUri,
            'headers' => [
                'PRIVATE-TOKEN' =>  $token,
            ]
        ]);

        return new Client($httpClient, $projectID);
    }
}