<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Resource;

class Branch
{
    private string $name;
    private bool $merged;
    private bool $protected;
    private bool $developersCanPush;
    private bool $developersCanMerge;
    private bool $canPush;
    private bool $default;
    private string $webUrl;
    private Commit $commit;

    public function __construct(
        string $name,
        bool $merged,
        bool $protected,
        bool $developersCanPush,
        bool $developersCanMerge,
        bool $canPush,
        bool $default,
        string $webUrl,
        Commit $commit
    ) {
        $this->name               = $name;
        $this->merged             = $merged;
        $this->protected          = $protected;
        $this->developersCanPush  = $developersCanPush;
        $this->developersCanMerge = $developersCanMerge;
        $this->canPush            = $canPush;
        $this->default            = $default;
        $this->webUrl             = $webUrl;
        $this->commit             = $commit;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function isDevelopersCanMerge(): bool
    {
        return $this->developersCanMerge;
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

    public function getCommit(): Commit
    {
        return $this->commit;
    }
}
