<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Domain;

class Branch
{
    private string $name;
    private Commit $commit;
    private bool $merged;
    private bool $protected;
    private bool $developersCanPush;
    private bool $developerCanMerge;
    private bool $canPush;
    private bool $default;
    private string $webUrl;

    public function __construct(
        string $name,
        Commit $commit,
        bool $merged,
        bool $protected,
        bool $developersCanPush,
        bool $developerCanMerge,
        bool $canPush,
        bool $default,
        string $webUrl
    ) {
        $this->name              = $name;
        $this->commit            = $commit;
        $this->merged            = $merged;
        $this->protected         = $protected;
        $this->developersCanPush = $developersCanPush;
        $this->developerCanMerge = $developerCanMerge;
        $this->canPush           = $canPush;
        $this->default           = $default;
        $this->webUrl            = $webUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCommit(): Commit
    {
        return $this->commit;
    }

    public function isMerged(): bool
    {
        return $this->merged;
    }

    public function isProtected(): bool
    {
        return $this->protected;
    }

    public function isDevelopersCanPush(): bool
    {
        return $this->developersCanPush;
    }

    public function isDeveloperCanMerge(): bool
    {
        return $this->developerCanMerge;
    }

    public function isCanPush(): bool
    {
        return $this->canPush;
    }

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
