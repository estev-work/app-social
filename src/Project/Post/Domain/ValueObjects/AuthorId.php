<?php

declare(strict_types=1);

namespace App\Project\Post\Domain\ValueObjects;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AuthorId
{
    #[Assert\Uuid(versions: 4)]
    #[Assert\NotBlank]
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getValue(): ?string
    {
        return $this->id;
    }
}