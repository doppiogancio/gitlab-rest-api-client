<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab;

use DoppioGancio\GitLab\Api\BranchApi;
use DoppioGancio\GitLab\Api\GroupApi;
use DoppioGancio\GitLab\Api\MergeRequestApi;
use DoppioGancio\GitLab\Api\ProjectApi;
use DoppioGancio\GitLab\Repository\BranchRepository;
use DoppioGancio\GitLab\Repository\MergeRequestRepository;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface as HttpClient;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class Client
{
    private HttpClient $client;
    private Serializer $serializer;
    private UrlBuilder $urlBuilder;

    public function __construct(HttpClient $client, string $projectId)
    {
        $this->client     = $client;
        $this->serializer = SerializerBuilder::create()->build();
        $this->urlBuilder = new UrlBuilder($projectId);
    }

    public function group(): GroupApi
    {
        return new GroupApi(
            $this->client,
            $this->serializer
        );
    }

    public function project(): ProjectApi
    {
        return new ProjectApi(
            $this->client,
            $this->serializer
        );
    }

    public function branch(): BranchApi
    {
        return new BranchApi(
            $this->client,
            $this->serializer,
            $this->urlBuilder
        );
    }

    public function mergeRequest(): MergeRequestApi
    {
        return new MergeRequestApi(
            $this->client,
            $this->serializer,
            $this->urlBuilder
        );
    }
}
