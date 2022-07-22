<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab;

use GuzzleHttp\Client as HttpClient;

class ClientFactory
{
    public static function create(string $baseUri, string $token): Client
    {
        $httpClient = new HttpClient([
            'base_uri' => $baseUri,
            'headers' => ['PRIVATE-TOKEN' => $token],
        ]);

        return new Client($httpClient);
    }
}
