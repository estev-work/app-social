<?php

namespace App\Tests\Project\Post\Domain\Constants;

use App\Project\Post\Domain\Constants\ContentConstants;
use PHPUnit\Framework\TestCase;

class ContentConstantsTest extends TestCase
{
    public function testContentConstantsAreIntegers(): void
    {
        $this->assertIsInt(ContentConstants::MIN_LENGTH);
        $this->assertIsInt(ContentConstants::MAX_LENGTH);
    }

    public function testContentConstantsMaxIsGreaterThanMin(): void
    {
        $this->assertGreaterThan(ContentConstants::MIN_LENGTH, ContentConstants::MAX_LENGTH);
    }

    public function testContentConstantsMinGreaterThanZero(): void
    {
        $this->assertGreaterThan(0, ContentConstants::MIN_LENGTH);
    }

    public function testContentConstantsMaxGreaterThanZero(): void
    {
        $this->assertGreaterThan(0, ContentConstants::MAX_LENGTH);
    }
}
