<?php

namespace DoppioGancio\GitLab\Url;

class UrlBuilder
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function endpoint(string $endpoint, array $queryParameters = []): string
    {
        $url = sprintf("%s/%s", $this->basePath, $endpoint);
        if (!empty($queryParameters)) {
            $url = sprintf("%s?%s", $url, http_build_query($queryParameters));
        }
        return $url;
    }
}