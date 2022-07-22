<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Repository;

use DoppioGancio\GitLab\Resource\MergeRequest;
use DoppioGancio\GitLab\Resource\MergeRequestCreate;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

class MergeRequestRepository
{
    private ClientInterface $client;
    private Serializer $serializer;
    private UrlBuilder $urlBuilder;

    public function __construct(ClientInterface $client, Serializer $serializer, UrlBuilder $urlBuilder)
    {
        $this->client     = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param array<string,string> $queryParams
     */
    public function list(array $queryParams = []): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint('merge_requests', $queryParams)
        )->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf('array<int,%s>', MergeRequest::class),
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
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }

    public function merge(int $mergeRequestIid): PromiseInterface
    {
        return $this->client->requestAsync(
            'PUT',
            $this->urlBuilder->endpoint(sprintf('%d/merge', $mergeRequestIid))
        )->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }
}
