<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Resource;

use function implode;

class MergeRequestCreate
{
    private string $id;
    private string $sourceBranch;
    private string $targetBranch;
    private string $title;
    private string $description = '';

    /** @var string[] */
    private array $labels            = [];
    private bool $squash             = false;
    private bool $removeSourceBranch = true;

    public function __construct(
        string $id,
        string $sourceBranch,
        string $targetBranch,
        string $title,
        string $description
    ) {
        $this->id           = $id;
        $this->sourceBranch = $sourceBranch;
        $this->targetBranch = $targetBranch;
        $this->title        = $title;
        $this->description  = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSourceBranch(): string
    {
        return $this->sourceBranch;
    }

    public function getTargetBranch(): string
    {
        return $this->targetBranch;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function addLabel(string $label): void
    {
        $this->labels[] = $label;
    }

    /**
     * @return string[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    public function getLabelsAsString(): string
    {
        return implode(',', $this->getLabels());
    }

    public function squashTheCommits(): bool
    {
        return $this->squash;
    }

    public function removeSourceBranch(): bool
    {
        return $this->removeSourceBranch;
    }
}
