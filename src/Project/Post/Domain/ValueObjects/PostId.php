<?php

namespace App\Project\Post\Domain\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final class PostId
{
    #[Assert\Uuid]
    private string $value;

    public function __construct(string $value = null)
    {
        $this->value = $value ?? Uuid::v4();
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}