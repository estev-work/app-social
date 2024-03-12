<?php

namespace App\Tests\Project\User\Domain\Constants;

use App\Project\User\Domain\Constants\UserNameConstants;
use PHPUnit\Framework\TestCase;

class UserNameConstantsTest extends TestCase
{
    public function testUserNameConstantsAreIntegers(): void
    {
        $this->assertIsInt(UserNameConstants::MIN_LENGTH);
        $this->assertIsInt(UserNameConstants::MAX_LENGTH);
    }

    public function testUserNameConstantsMaxIsGreaterThanMin(): void
    {
        $this->assertGreaterThan(UserNameConstants::MIN_LENGTH, UserNameConstants::MAX_LENGTH);
    }

    public function testUserNameConstantsMinGreaterThanZero(): void
    {
        $this->assertGreaterThan(0, UserNameConstants::MIN_LENGTH);
    }

    public function testUserNameConstantsMaxGreaterThanZero(): void
    {
        $this->assertGreaterThan(0, UserNameConstants::MAX_LENGTH);
    }
}
