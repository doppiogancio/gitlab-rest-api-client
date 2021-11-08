<?php

declare(strict_types=1);

namespace DoppioGancio\GitLab\Domain;

class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $state;
    private string $avatar;
    private string $webUrl;

    public function __construct(int $id, string $name, string $username, string $state, string $avatar, string $webUrl)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->username = $username;
        $this->state    = $state;
        $this->avatar   = $avatar;
        $this->webUrl   = $webUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
