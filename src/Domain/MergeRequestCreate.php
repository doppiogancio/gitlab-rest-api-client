<?php

namespace DoppioGancio\GitLab\Domain;

class MergeRequestCreate
{
    private string $id;
    private string $sourceBranch;
    private string $targetBranch;
    private string $title;
    private string $description = '';
    private array $labels = [];
    private bool $squash = false;
    private bool $removeSourceBranch = true;

    /**
     * @param string $id
     * @param string $sourceBranch
     * @param string $targetBranch
     * @param string $title
     * @param string $description
     */
    public function __construct(string $id, string $sourceBranch, string $targetBranch, string $title, string $description)
    {
        $this->id = $id;
        $this->sourceBranch = $sourceBranch;
        $this->targetBranch = $targetBranch;
        $this->title = $title;
        $this->description = $description;
    }

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
    public function getSourceBranch(): string
    {
        return $this->sourceBranch;
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
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function addLabel(string $label): void
    {
        $this->labels[] = $label;
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    public function getLabelsAsString(): string
    {
        return implode(',', $this->getLabels());
    }

    /**
     * @return bool
     */
    public function squashTheCommits(): bool
    {
        return $this->squash;
    }

    /**
     * @return bool
     */
    public function removeSourceBranch(): bool
    {
        return $this->removeSourceBranch;
    }
}
