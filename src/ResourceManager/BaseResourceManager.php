<?php

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\Serializer;

abstract class BaseResourceManager
{
    protected ClientInterface $client;
    protected Serializer $serializer;
    protected UrlBuilder $urlBuilder;

    public function __construct(ClientInterface $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = new UrlBuilder();
    }
}