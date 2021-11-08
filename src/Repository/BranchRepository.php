<?php

namespace DoppioGancio\GitLab\Repository;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use DoppioGancio\GitLab\Domain\Branch;
use DoppioGancio\GitLab\Url\UrlBuilder;
use JMS\Serializer\Serializer;

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
        $this->client = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return Branch[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint('repository/branches')
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                $response->getBody(),
                sprintf("array<int,%s>", Branch::class),
                'json'
            );
        });
    }

    /**
     * @param string $branchName
     * @param string $ref
     * @return PromiseInterface<Branch>
     */
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
                $response->getBody(),
                Branch::class,
                'json'
            );
        });
    }
}