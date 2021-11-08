<?php

namespace DoppioGancio\GitLab\Repository;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use DoppioGancio\GitLab\Domain\MergeRequest;
use DoppioGancio\GitLab\Domain\MergeRequestCreate;
use JMS\Serializer\Serializer;
use DoppioGancio\GitLab\Url\UrlBuilder;

class MergeRequestRepository
{
    private ClientInterface $client;
    private Serializer $serializer;
    private UrlBuilder $urlBuilder;

    /**
     * @param ClientInterface $client
     * @param Serializer $serializer
     * @param UrlBuilder $urlBuilder
     */
    public function __construct(ClientInterface $client, Serializer $serializer, UrlBuilder $urlBuilder)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return MergeRequest[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $queryParams = []): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint('merge_requests', $queryParams)
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                $response->getBody(),
                sprintf("array<int,%s>", MergeRequest::class),
                'json'
            );
        });
    }

    public function create(MergeRequestCreate $mr): PromiseInterface
    {
        return $this->client->requestAsync(
            'POST',
            $this->urlBuilder->endpoint(
                'merge_requests',
                $this->serializer->toArray($mr)
            )
        )->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }


    /**
     * @param int $mergeRequestIid
     *
     * @return PromiseInterface<MergeRequest>
     */
    public function merge(int $mergeRequestIid): PromiseInterface
    {
        return $this->client->requestAsync(
            'PUT',
            $this->urlBuilder->endpoint(sprintf("%d/merge", $mergeRequestIid))
        )->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }
}