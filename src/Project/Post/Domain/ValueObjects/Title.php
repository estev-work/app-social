<?php

namespace App\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\Constants\TitleConstants;
use Symfony\Component\Validator\Constraints as Assert;

final class Title
{
    #[Assert\Length(min: TitleConstants::MIN_LENGTH, max: TitleConstants::MAX_LENGTH)]
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->title;
    }
}