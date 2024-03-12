<?php

namespace App\Tests\Project\Post\Domain\Constants;

use App\Project\Post\Domain\Constants\TitleConstants;
use PHPUnit\Framework\TestCase;

class TitleConstantsTest extends TestCase
{
    public function testTitleConstantsAreIntegers(): void
    {
        $this->assertIsInt(TitleConstants::MIN_LENGTH);
        $this->assertIsInt(TitleConstants::MAX_LENGTH);
    }

    public function testTitleConstantsMaxIsGreaterThanMin(): void
    {
        $this->assertGreaterThan(TitleConstants::MIN_LENGTH, TitleConstants::MAX_LENGTH);
    }

    public function testTitleConstantsMinGreaterThanZero(): void
    {
        $this->assertGreaterThan(0, TitleConstants::MIN_LENGTH);
    }

    public function testTitleConstantsMaxGreaterThanZero(): void
    {
        $this->assertGreaterThan(0, TitleConstants::MAX_LENGTH);
    }
}
