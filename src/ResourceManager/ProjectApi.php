<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\Project;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

class ProjectApi extends BaseResourceManager
{
    public function list(int $groupId): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('groups/%d/projects', $groupId), [
                'per_page' => 100,
            ])
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf("array<%s>", Project::class),
                'json'
            );
        });
    }

    public function get(string $projectId): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('/projects/%s', $projectId))
        )->then(function (ResponseInterface $response): Project {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                Project::class,
                'json'
            );
        });
    }
}