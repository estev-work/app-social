<?php

namespace App\Project\Post\Domain\ValueObjects;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class PostId
{
    #[Assert\Uuid(versions: 4)]
    private string $id;

    public function __construct(string $id = null)
    {
        $this->id = ($id == null) && empty($id) ? Uuid::v4()->toRfc4122() : $id;
    }

    public function getValue(): ?string
    {
        return $this->id;
    }
}