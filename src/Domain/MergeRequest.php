<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Domain;

use JMS\Serializer\Annotation\Type;

class MergeRequest
{
    private int $id;
    private int $iid;
    private int $projectId;
    private string $title;
    private string $description;

    private string $state;
    private string $createdAt;
    private string $updatedAt;
    private ?User $mergedBy   = null;
    private ?string $mergedAt = null;

    private ?User $closedBy   = null;
    private ?string $closedAt = null;

    private string $targetBranch;
    private string $sourceBranch;
    private int $userNotesCount = 0;
    private int $upvotes        = 0;
    private int $downvotes      = 0;
    private User $author;

    /** @Type("DoppioGancio\GitLab\Domain\User") */
    private ?User $assignee;

    /**
     * @Type("array<int,DoppioGancio\GitLab\Domain\User>")
     * @var User[]
     */
    private array $assignees;

    /**
     * @Type("array<int,DoppioGancio\GitLab\Domain\User>")
     * @var User[]
     */
    private array $reviewers;

    private int $sourceProjectId;
    private int $targetProjectId;

    private bool $draft;
    private bool $workInProgress;

    /** @Type("DoppioGancio\GitLab\Domain\Milestone") */
    private ?Milestone $milestone;

    private bool $mergeWhenPipelineSucceeds;
    private string $mergeStatus;
    private string $sha;
    private ?string $mergeCommitSha;
    private ?string $squashCommitSha;

    /**
     * @Type("array<int,string>")
     * @var string[]
     */
    private array $labels;

    /**
     * @param User[]   $assignees
     * @param User[]   $reviewers
     * @param string[] $labels
     */
    public function __construct(
        int $id,
        int $iid,
        int $projectId,
        string $title,
        string $description,
        string $state,
        string $createdAt,
        string $updatedAt,
        ?User $mergedBy,
        ?string $mergedAt,
        ?User $closedBy,
        ?string $closedAt,
        string $targetBranch,
        string $sourceBranch,
        int $userNotesCount,
        int $upvotes,
        int $downvotes,
        User $author,
        ?User $assignee,
        array $assignees,
        array $reviewers,
        int $sourceProjectId,
        int $targetProjectId,
        bool $draft,
        bool $workInProgress,
        ?Milestone $milestone,
        bool $mergeWhenPipelineSucceeds,
        string $mergeStatus,
        string $sha,
        ?string $mergeCommitSha,
        ?string $squashCommitSha,
        array $labels
    ) {
        $this->id                        = $id;
        $this->iid                       = $iid;
        $this->projectId                 = $projectId;
        $this->title                     = $title;
        $this->description               = $description;
        $this->state                     = $state;
        $this->createdAt                 = $createdAt;
        $this->updatedAt                 = $updatedAt;
        $this->mergedBy                  = $mergedBy;
        $this->mergedAt                  = $mergedAt;
        $this->closedBy                  = $closedBy;
        $this->closedAt                  = $closedAt;
        $this->targetBranch              = $targetBranch;
        $this->sourceBranch              = $sourceBranch;
        $this->userNotesCount            = $userNotesCount;
        $this->upvotes                   = $upvotes;
        $this->downvotes                 = $downvotes;
        $this->author                    = $author;
        $this->assignee                  = $assignee;
        $this->assignees                 = $assignees;
        $this->reviewers                 = $reviewers;
        $this->sourceProjectId           = $sourceProjectId;
        $this->targetProjectId           = $targetProjectId;
        $this->draft                     = $draft;
        $this->workInProgress            = $workInProgress;
        $this->milestone                 = $milestone;
        $this->mergeWhenPipelineSucceeds = $mergeWhenPipelineSucceeds;
        $this->mergeStatus               = $mergeStatus;
        $this->sha                       = $sha;
        $this->mergeCommitSha            = $mergeCommitSha;
        $this->squashCommitSha           = $squashCommitSha;
        $this->labels                    = $labels;
    }

    public function getId(): int
    {
        // TODO to be completed
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

    public function getMergedBy(): ?User
    {
        return $this->mergedBy;
    }

    public function getMergedAt(): ?string
    {
        return $this->mergedAt;
    }

    public function getClosedBy(): ?User
    {
        return $this->closedBy;
    }

    public function getClosedAt(): ?string
    {
        return $this->closedAt;
    }

    public function getTargetBranch(): string
    {
        return $this->targetBranch;
    }

    public function getSourceBranch(): string
    {
        return $this->sourceBranch;
    }

    public function getUserNotesCount(): int
    {
        return $this->userNotesCount;
    }

    public function getUpvotes(): int
    {
        return $this->upvotes;
    }

    public function getDownvotes(): int
    {
        return $this->downvotes;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getAssignee(): ?User
    {
        return $this->assignee;
    }

    /**
     * @return User[]
     */
    public function getAssignees(): array
    {
        return $this->assignees;
    }

    /**
     * @return User[]
     */
    public function getReviewers(): array
    {
        return $this->reviewers;
    }

    public function getSourceProjectId(): int
    {
        return $this->sourceProjectId;
    }

    public function getTargetProjectId(): int
    {
        return $this->targetProjectId;
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }

    public function isWorkInProgress(): bool
    {
        return $this->workInProgress;
    }

    public function getMilestone(): ?Milestone
    {
        return $this->milestone;
    }

    public function isMergeWhenPipelineSucceeds(): bool
    {
        return $this->mergeWhenPipelineSucceeds;
    }

    public function getMergeStatus(): string
    {
        return $this->mergeStatus;
    }

    public function getSha(): string
    {
        return $this->sha;
    }

    public function getMergeCommitSha(): ?string
    {
        return $this->mergeCommitSha;
    }

    public function getSquashCommitSha(): ?string
    {
        return $this->squashCommitSha;
    }

    /**
     * @return string[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }
}
