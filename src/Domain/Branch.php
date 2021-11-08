<?php

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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Commit
     */
    public function getCommit(): Commit
    {
        return $this->commit;
    }

    /**
     * @return bool
     */
    public function isMerged(): bool
    {
        return $this->merged;
    }

    /**
     * @return bool
     */
    public function isProtected(): bool
    {
        return $this->protected;
    }

    /**
     * @return bool
     */
    public function isDevelopersCanPush(): bool
    {
        return $this->developersCanPush;
    }

    /**
     * @return bool
     */
    public function isDeveloperCanMerge(): bool
    {
        return $this->developerCanMerge;
    }

    /**
     * @return bool
     */
    public function isCanPush(): bool
    {
        return $this->canPush;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }

    /**
     * @return string
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}