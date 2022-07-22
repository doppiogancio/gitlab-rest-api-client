<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Api;

use DoppioGancio\GitLab\Url\UrlBuilder;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\Serializer;

abstract class BaseApi
{
    protected ClientInterface $client;
    protected Serializer $serializer;
    protected UrlBuilder $urlBuilder;

    public function __construct(ClientInterface $client, Serializer $serializer)
    {
        $this->client     = $client;
        $this->serializer = $serializer;
        $this->urlBuilder = new UrlBuilder();
    }
}
