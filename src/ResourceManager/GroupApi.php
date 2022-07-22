<?php

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\Group;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

class GroupApi extends BaseResourceManager
{
    public function list(): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint('groups', [
                'per_page' => 100,
            ])
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf("array<%s>", Group::class),
                'json'
            );
        });
    }
}