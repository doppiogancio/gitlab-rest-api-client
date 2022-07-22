<?php

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\MergeRequest;
use DoppioGancio\GitLab\Resource\Project;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;

class MergeRequestApi
{
    private ClientInterface $client;
    private Serializer $serializer;
    private UrlBuilder $urlBuilder;

    public function __construct(ClientInterface $client, Serializer $serializer, UrlBuilder $urlBuilder)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = $urlBuilder;
    }

    public function list(string $projectId, array $parameters = []): PromiseInterface
    {
        $url = $this->urlBuilder->endpoint(sprintf('projects/%s/merge_requests', $projectId), $parameters);

        // https://gitlab.com/api/v4/projects/{{projectId}}/merge_requests?state=merged&author_username=doppiogancio&order_by=updated_at&sort=desc

        return $this->client->requestAsync('GET', $url)
            ->then(function (ResponseInterface $response): array {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                sprintf("array<%s>", MergeRequest::class),
                'json'
            );
        });
    }

    public function get(string $projectId, int $mergeRequestIid): PromiseInterface
    {
        return $this->client->requestAsync(
            'GET',
            $this->urlBuilder->endpoint(sprintf('projects/%s/merge_requests/%d', $projectId, $mergeRequestIid))
        )->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }
}