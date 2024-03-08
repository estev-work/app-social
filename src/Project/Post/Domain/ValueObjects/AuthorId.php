<?php

declare(strict_types=1);

namespace App\Project\Post\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AuthorId
{
    #[Assert\Uuid(versions: 4)]
    #[Assert\NotBlank]
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}