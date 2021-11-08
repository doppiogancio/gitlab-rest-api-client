<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Domain;

class Milestone
{
    private int $id;
    private int $iid;
    private int $projectId;
    private string $title;
    private string $description;
    private string $state;
    private string $createdAt;
    private string $updatedAt;
    private string $dueDate;
    private string $startDate;
    private string $webUrl;

    public function __construct(
        int $id,
        int $iid,
        int $projectId,
        string $title,
        string $description,
        string $state,
        string $createdAt,
        string $updatedAt,
        string $dueDate,
        string $startDate,
        string $webUrl
    ) {
        $this->id          = $id;
        $this->iid         = $iid;
        $this->projectId   = $projectId;
        $this->title       = $title;
        $this->description = $description;
        $this->state       = $state;
        $this->createdAt   = $createdAt;
        $this->updatedAt   = $updatedAt;
        $this->dueDate     = $dueDate;
        $this->startDate   = $startDate;
        $this->webUrl      = $webUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIid(): int
    {
        return $this->iid;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
