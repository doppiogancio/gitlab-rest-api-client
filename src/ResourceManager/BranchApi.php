<?php

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\Branch;
use DoppioGancio\GitLab\Resource\Project;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

class BranchApi extends BaseResourceManager
{
    public function list(string $projectId): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('projects/%s/repository/branches', $projectId))
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf("array<%s>", Branch::class),
                'json'
            );
        });
    }

    public function get(string $projectId, string $branchName): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('projects/%s/repository/branches/%s', $projectId, $branchName))
        )->then(function (ResponseInterface $response): Branch {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                Branch::class,
                'json'
            );
        });
    }

    // POST /projects/:id/repository/branches
    // DELETE /projects/:id/repository/branches/:branch
    // DELETE /projects/:id/repository/merged_branches
}