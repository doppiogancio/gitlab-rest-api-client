<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Resource;

class Group
{
    private int $id;
    private string $webUrl;
    private string $name;
    private string $path;
    private string $description;
    private string $fullName;
    private string $fullPath;

    public function __construct(
        int $id,
        string $webUrl,
        string $name,
        string $path,
        string $description,
        string $fullName,
        string $fullPath
    ) {
        $this->id          = $id;
        $this->webUrl      = $webUrl;
        $this->name        = $name;
        $this->path        = $path;
        $this->description = $description;
        $this->fullName    = $fullName;
        $this->fullPath    = $fullPath;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getFullPath(): string
    {
        return $this->fullPath;
    }
}
