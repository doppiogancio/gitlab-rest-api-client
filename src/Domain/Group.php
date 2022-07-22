<?php

namespace DoppioGancio\GitLab\Domain;

class Group
{
    private int $id;
    private string $webUrl;
    private string $name;
    private string $path;
    private string $description;
    private string $fullName;
    private string $fullPath;

    /**
     * @param int $id
     * @param string $webUrl
     * @param string $name
     * @param string $path
     * @param string $description
     * @param string $fullName
     * @param string $fullPath
     */
    public function __construct(int $id, string $webUrl, string $name, string $path, string $description, string $fullName, string $fullPath)
    {
        $this->id = $id;
        $this->webUrl = $webUrl;
        $this->name = $name;
        $this->path = $path;
        $this->description = $description;
        $this->fullName = $fullName;
        $this->fullPath = $fullPath;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->fullPath;
    }
}
