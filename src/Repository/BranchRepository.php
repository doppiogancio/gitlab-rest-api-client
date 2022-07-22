<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Repository;

use DoppioGancio\GitLab\Resource\Branch;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

class BranchRepository
{
    private ClientInterface $client;
    private Serializer $serializer;
    private UrlBuilder $urlBuilder;

    public function __construct(
        ClientInterface $client,
        Serializer $serializer,
        UrlBuilder $urlBuilder
    ) {
        $this->client     = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @throws GuzzleException
     */
    public function list(): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint('repository/branches')
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf('array<int,%s>', Branch::class),
                'json'
            );
        });
    }

    public function create(string $branchName, string $ref): PromiseInterface
    {
        return $this->client->requestAsync(
            'POST',
            $this->urlBuilder->endpoint('repository/branches', [
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
}
