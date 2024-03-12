<?php

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\ValueObjects\PublishedStatus;
use PHPUnit\Framework\TestCase;

class PublishedStatusTest extends TestCase
{
    public function testPublishedStatus(): void
    {
        $publishedStatus = new PublishedStatus();
        $this->assertFalse($publishedStatus->getValue());
    }

    public function testPublishedStatusIsBoolean(): void
    {
        $publishedStatus = new PublishedStatus();
        $this->assertIsBool($publishedStatus->getValue());
    }

    public function testPublishedStatusIsTrue(): void
    {
        $publishedStatus = new PublishedStatus(true);
        $this->assertTrue($publishedStatus->getValue());
    }

    public function testPublishedStatusIsFalse(): void
    {
        $publishedStatus = new PublishedStatus(false);
        $this->assertFalse($publishedStatus->getValue());
    }

    public function testPublishedStatusIsNotNull(): void
    {
        $publishedStatus = new PublishedStatus();
        $this->assertNotNull($publishedStatus->getValue());
    }

    public function testPublishedStatusIsNotNullTrue(): void
    {
        $publishedStatus = new PublishedStatus(true);
        $this->assertNotNull($publishedStatus->getValue());
    }

    public function testPublishedStatusIsNotNullFalse(): void
    {
        $publishedStatus = new PublishedStatus(false);
        $this->assertNotNull($publishedStatus->getValue());
    }
}
