<?php

declare(strict_types=1);

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
    private ?array $parentIds;


    private string $authorEmail;
    private string $authorName;
    private string $authoredDate;


    private string $committerEmail;
    private string $committerName;
    private string $committedDate;

    /**
     * @param ?string[] $parentIds
     */
    public function __construct(
        string $id,
        string $shortId,
        string $createdAt,
        string $title,
        string $message,
        ?array $parentIds,
        string $authorEmail,
        string $authorName,
        string $authoredDate,
        string $committerEmail,
        string $committerName,
        string $committedDate
    ) {
        $this->id             = $id;
        $this->shortId        = $shortId;
        $this->createdAt      = $createdAt;
        $this->title          = $title;
        $this->message        = $message;
        ? $this->parentIds    = $parentIds;
        $this->authorEmail    = $authorEmail;
        $this->authorName     = $authorName;
        $this->authoredDate   = $authoredDate;
        $this->committerEmail = $committerEmail;
        $this->committerName  = $committerName;
        $this->committedDate  = $committedDate;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getShortId(): string
    {
        return $this->shortId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string[]|null
     */
    public function getParentIds(): ?array
    {
        return $this->parentIds;
    }

    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function getAuthoredDate(): string
    {
        return $this->authoredDate;
    }

    public function getCommitterEmail(): string
    {
        return $this->committerEmail;
    }

    public function getCommitterName(): string
    {
        return $this->committerName;
    }

    public function getCommittedDate(): string
    {
        return $this->committedDate;
    }
}
