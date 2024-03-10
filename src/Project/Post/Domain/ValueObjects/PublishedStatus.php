<?php

namespace App\Project\Post\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints as Assert;

final class PublishedStatus
{
    #[Assert\Choice(choices: [true, false])]
    #[Assert\NotNull]
    private bool $isPublished;

    public function __construct(bool $isPublished = false)
    {
        $this->isPublished = $isPublished;
    }

    public function getValue(): bool
    {
        return $this->isPublished;
    }
}