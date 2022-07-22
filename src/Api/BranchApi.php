<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\Branch;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

class BranchApi extends BaseApi
{
    public function list(string $projectId): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('/projects/%s/repository/branches', $projectId))
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf('array<%s>', Branch::class),
                'json'
            );
        });
    }

    public function get(string $projectId, string $branchName): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('/projects/%s/repository/branches/%s', $projectId, $branchName))
        )->then(function (ResponseInterface $response): Branch {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                Branch::class,
                'json'
            );
        });
    }

    public function create(string $projectID, string $branchName, string $ref): PromiseInterface
    {
        $endpoint = sprintf('/projects/%s/repository/branches', $projectID);
        return $this->client->requestAsync(
            'POST',
            $this->urlBuilder->endpoint($endpoint, [
                'branch' => $branchName,
                'ref' => $ref,
            ])
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
