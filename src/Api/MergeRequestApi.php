<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\MergeRequest;
use DoppioGancio\GitLab\Resource\MergeRequestCreate;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

class MergeRequestApi extends BaseApi
{
    /**
     * @param array<string,int|bool|string> $parameters
     */
    public function list(string $projectId, array $parameters = []): PromiseInterface
    {
        // https://gitlab.com/api/v4/projects/{{projectId}}/merge_requests?state=merged&author_username=doppiogancio&order_by=updated_at&sort=desc
        $url = $this->urlBuilder->endpoint(sprintf('projects/%s/merge_requests', $projectId), $parameters);

        return $this->client->requestAsync('GET', $url)
            ->then(function (ResponseInterface $response): array {
                return $this->serializer->deserialize(
                    (string) $response->getBody(),
                    sprintf('array<%s>', MergeRequest::class),
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

    public function merge(string $projectID, int $mergeRequestIid): PromiseInterface
    {
        $url = $this->urlBuilder->endpoint(sprintf('projects/%s/%d/merge', $projectID, $mergeRequestIid));
        return $this->client->requestAsync(
            'PUT',
            $url //$this->urlBuilder->endpoint(sprintf('%d/merge', $mergeRequestIid))
        )->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }
}
