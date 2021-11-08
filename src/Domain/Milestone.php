<?php

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

    /**
     * @param int $id
     * @param int $iid
     * @param int $projectId
     * @param string $title
     * @param string $description
     * @param string $state
     * @param string $createdAt
     * @param string $updatedAt
     * @param string $dueDate
     * @param string $startDate
     * @param string $webUrl
     */
    public function __construct(int $id, int $iid, int $projectId, string $title, string $description, string $state, string $createdAt, string $updatedAt, string $dueDate, string $startDate, string $webUrl)
    {
        $this->id = $id;
        $this->iid = $iid;
        $this->projectId = $projectId;
        $this->title = $title;
        $this->description = $description;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->dueDate = $dueDate;
        $this->startDate = $startDate;
        $this->webUrl = $webUrl;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIid(): int
    {
        return $this->iid;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}