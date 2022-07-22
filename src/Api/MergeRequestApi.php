<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Resource\MergeRequest;
use DoppioGancio\GitLab\Resource\MergeRequestCreate;
use GuzzleHttp\Promise\PromiseInterface;
use League\Uri\UriTemplate;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

/**
 * https://docs.gitlab.com/ee/api/merge_requests.html
 */
class MergeRequestApi extends BaseApi
{
    /**
     * @param array<string,int|bool|string> $parameters
     */
    public function list(string $projectId, array $parameters = []): PromiseInterface
    {
        $uriTemplate = new UriTemplate(
            '/api/v4/projects/{projectId}/merge_requests'
        );

        $parameters['projectId'] = $projectId;
        $uri = $uriTemplate->expand($parameters);

        return $this->client->requestAsync('GET', (string) $uri)
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
        $uriTemplate = new UriTemplate(
            '/api/v4/projects/{projectId}/merge_requests/{mergeRequestId}'
        );

        $parameters['projectId'] = $projectId;
        $parameters['mergeRequestId'] = $mergeRequestIid;
        $uri = $uriTemplate->expand($parameters);

        return $this->client->requestAsync('GET', (string) $uri)->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }

    public function create(string $projectId, MergeRequestCreate $mr): PromiseInterface
    {
        $uriTemplate = new UriTemplate(
            '/api/v4/projects/{projectId}/merge_requests'
        );

        $parameters['projectId'] = $projectId;
        $uri = $uriTemplate->expand($parameters);

        return $this->client->requestAsync('POST', (string) $uri)
            ->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }

    public function merge(string $projectId, int $mergeRequestIid): PromiseInterface
    {
        $uriTemplate = new UriTemplate(
            '/api/v4/projects/{projectId}/merge_requests/{mergeRequestIid}/merge',
        );

        $parameters['projectId'] = $projectId;
        $parameters['mergeRequestIid'] = $mergeRequestIid;
        $uri = $uriTemplate->expand($parameters);

        return $this->client->requestAsync('PUT', (string) $uri)
            ->then(function (ResponseInterface $response): MergeRequest {
            return $this->serializer->deserialize(
                (string) $response->getBody(),
                MergeRequest::class,
                'json'
            );
        });
    }
}
