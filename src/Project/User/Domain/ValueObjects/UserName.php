<?php

namespace App\Project\User\Domain\ValueObjects;

use Symfony\Component\Uid\Uuid;

class UserName
{
    public function __construct(private ?string $value = null)
    {
        $this->value = $this->value ?? Uuid::v4();
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    public function change(string $newUserName): void
    {
        $this->value = $newUserName;
    }
}