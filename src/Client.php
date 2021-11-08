<?php

namespace DoppioGancio\GitLab;

use GuzzleHttp\ClientInterface;
use JMS\Serializer\Serializer;
use DoppioGancio\GitLab\Url\UrlBuilder;
use DoppioGancio\GitLab\Repository\BranchRepository;
use DoppioGancio\GitLab\Repository\MergeRequestRepository;
use JMS\Serializer\SerializerBuilder;

class Client
{
    private ClientInterface $client;
    private Serializer $serializer;
    private UrlBuilder $urlBuilder;

    public function __construct(ClientInterface $client, string $projectName)
    {
        $this->client = $client;
        $this->serializer = SerializerBuilder::create()->build();
        $this->urlBuilder = new UrlBuilder(sprintf('/api/v4/projects/%s', $projectName));
    }

    public function branch(): BranchRepository
    {
        return new BranchRepository(
            $this->client,
            $this->serializer,
            $this->urlBuilder
        );
    }

    public function mergeRequest(): MergeRequestRepository
    {
        return new MergeRequestRepository(
            $this->client,
            $this->serializer,
            $this->urlBuilder
        );
    }
}