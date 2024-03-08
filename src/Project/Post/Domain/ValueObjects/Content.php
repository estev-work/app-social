<?php

declare(strict_types=1);

namespace App\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\Constants\ContentConstants;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class Content
{
    #[Assert\Length(min: ContentConstants::MIN_LENGTH, max: ContentConstants::MAX_LENGTH)]
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->content;
    }
}