<?php

namespace App\Project\User\Domain\ValueObjects;

use App\Project\User\Domain\Constants\UserNameConstants;
use Symfony\Component\Validator\Constraints as Assert;

class UserName
{
    #[Assert\Length(min: UserNameConstants::MIN_LENGTH, max: UserNameConstants::MAX_LENGTH)]
    private string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->userName;
    }
}