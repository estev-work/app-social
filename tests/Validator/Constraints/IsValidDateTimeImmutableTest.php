<?php

namespace App\Tests\Validator\Constraints;

use App\Validator\Constraints\IsValidDateTimeImmutable;
use PHPUnit\Framework\TestCase;

class IsValidDateTimeImmutableTest extends TestCase
{
    public function testIsValidDateTimeImmutable(): void
    {
        $constraint = new IsValidDateTimeImmutable();
        $this->assertEquals('The date "{{ string }}" is not a valid DateTimeImmutable object.', $constraint->message);
    }
}
