<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab;

use DoppioGancio\GitLab\Api\BranchApi;
use DoppioGancio\GitLab\Api\GroupApi;
use DoppioGancio\GitLab\Api\MergeRequestApi;
use DoppioGancio\GitLab\Api\ProjectApi;
use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface as HttpClient;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class Client
{
    private HttpClient $client;
    private Serializer $serializer;

    public function __construct(HttpClient $client)
    {
        $this->client     = $client;
        $this->serializer = SerializerBuilder::create()->build();
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
            $this->serializer
        );
    }

    public function mergeRequest(): MergeRequestApi
    {
        return new MergeRequestApi(
            $this->client,
            $this->serializer
        );
    }
}
