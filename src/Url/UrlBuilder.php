<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Url;

use function http_build_query;
use function sprintf;

class UrlBuilder
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @param array<string,string> $queryParameters
     */
    public function endpoint(string $endpoint, array $queryParameters = []): string
    {
        $url = sprintf('%s/%s', $this->basePath, $endpoint);
        if (! empty($queryParameters)) {
            $url = sprintf('%s?%s', $url, http_build_query($queryParameters));
        }

        return $url;
    }
}
