<?php

namespace DoppioGancio\GitLab\Domain;

use JMS\Serializer\Annotation\Type;

class Commit
{
    private string $id;
    private string $shortId;
    private string $createdAt;
    private string $title;
    private string $message;

    /**
     * @Type("array<int,string>")
     * @var string[]
     */
    private array $parentIds;


    private string $authorEmail;
    private string $authorName;
    private string $authoredDate;


    private string $committerEmail;
    private string $committerName;
    private string $committedDate;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortId(): string
    {
        return $this->shortId;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string[]
     */
    public function getParentIds(): array
    {
        return $this->parentIds;
    }

    /**
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getAuthoredDate(): string
    {
        return $this->authoredDate;
    }

    /**
     * @return string
     */
    public function getCommitterEmail(): string
    {
        return $this->committerEmail;
    }

    /**
     * @return string
     */
    public function getCommitterName(): string
    {
        return $this->committerName;
    }

    /**
     * @return string
     */
    public function getCommittedDate(): string
    {
        return $this->committedDate;
    }
}
