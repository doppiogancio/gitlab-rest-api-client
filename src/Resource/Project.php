<?php

namespace DoppioGancio\GitLab\Resource;

class Project
{
    private int $id;
    private ?string $description;
    private string $name;
    private string $nameWithNamespace;
    private string $path;
    private string $pathWithNamespace;

    public function getName(): string
    {
        return $this->name;
    }
}