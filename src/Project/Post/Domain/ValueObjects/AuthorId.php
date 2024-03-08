<?php

namespace App\Project\Post\Domain\ValueObjects;

final readonly class AuthorId
{
    public function __construct(private string $value)
    {
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}