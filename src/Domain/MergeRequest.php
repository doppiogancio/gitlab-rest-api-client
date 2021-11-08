<?php

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
    private ?User $mergedBy = null;
    private ?string $mergedAt = null;

    private ?User $closedBy = null;
    private ?string $closedAt = null;

    private string $targetBranch;
    private string $sourceBranch;
    private int $userNotesCount = 0;
    private int $upvotes = 0;
    private int $downvotes = 0;
    private User $author;

    /**
     * @Type("DoppioGancio\GitLab\Domain\User")
     * @var User|null
     */
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

    /**
     * @Type("DoppioGancio\GitLab\Domain\Milestone")
     * @var Milestone
     */
    private Milestone $milestone;

    private bool $mergeWithPipelineSucceeds;
    private string $mergeStatus;
    private string $sha;
    private ?string $mergeCommitSha;
    private ?string $squashCommitSha;

    /**
     * @Type("array<int,string>")
     * @var string[]
     */
    private array $labels;


    // TODO to be completed

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
     * @return User|null
     */
    public function getMergedBy(): ?User
    {
        return $this->mergedBy;
    }

    /**
     * @return string|null
     */
    public function getMergedAt(): ?string
    {
        return $this->mergedAt;
    }

    /**
     * @return User|null
     */
    public function getClosedBy(): ?User
    {
        return $this->closedBy;
    }

    /**
     * @return string|null
     */
    public function getClosedAt(): ?string
    {
        return $this->closedAt;
    }

    /**
     * @return string
     */
    public function getTargetBranch(): string
    {
        return $this->targetBranch;
    }

    /**
     * @return string
     */
    public function getSourceBranch(): string
    {
        return $this->sourceBranch;
    }

    /**
     * @return int
     */
    public function getUserNotesCount(): int
    {
        return $this->userNotesCount;
    }

    /**
     * @return int
     */
    public function getUpvotes(): int
    {
        return $this->upvotes;
    }

    /**
     * @return int
     */
    public function getDownvotes(): int
    {
        return $this->downvotes;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return User|null
     */
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

    /**
     * @return int
     */
    public function getSourceProjectId(): int
    {
        return $this->sourceProjectId;
    }

    /**
     * @return int
     */
    public function getTargetProjectId(): int
    {
        return $this->targetProjectId;
    }

    /**
     * @return bool
     */
    public function isDraft(): bool
    {
        return $this->draft;
    }

    /**
     * @return bool
     */
    public function isWorkInProgress(): bool
    {
        return $this->workInProgress;
    }

    /**
     * @return Milestone
     */
    public function getMilestone(): Milestone
    {
        return $this->milestone;
    }

    /**
     * @return bool
     */
    public function isMergeWithPipelineSucceeds(): bool
    {
        return $this->mergeWithPipelineSucceeds;
    }

    /**
     * @return string
     */
    public function getMergeStatus(): string
    {
        return $this->mergeStatus;
    }

    /**
     * @return string
     */
    public function getSha(): string
    {
        return $this->sha;
    }

    /**
     * @return string|null
     */
    public function getMergeCommitSha(): ?string
    {
        return $this->mergeCommitSha;
    }

    /**
     * @return string|null
     */
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
/*
{
    "discussion_locked": null,
  "should_remove_source_branch": true,
  "force_remove_source_branch": false,
  "allow_collaboration": false,
  "allow_maintainer_to_push": false,
  "web_url": "http://gitlab.example.com/my-group/my-project/merge_requests/1",
  "references": {
    "short": "!1",
    "relative": "my-group/my-project!1",
    "full": "my-group/my-project!1"
  },
  "time_stats": {
    "time_estimate": 0,
    "total_time_spent": 0,
    "human_time_estimate": null,
    "human_total_time_spent": null
  },
  "squash": false,
  "task_completion_status": {
    "count": 0,
    "completed_count": 0
  }
*/