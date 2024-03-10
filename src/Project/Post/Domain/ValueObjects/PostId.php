<?php

namespace App\Project\Post\Domain\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PostId
{
    #[Assert\Uuid(versions: 4)]
    private string $value;

    public function __construct(string $value = null)
    {
        $this->value = ($value == null) && empty($value) ? Uuid::v4()->toRfc4122() : $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}