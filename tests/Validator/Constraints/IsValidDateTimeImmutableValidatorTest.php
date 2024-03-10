<?php

namespace App\Tests\Validator\Constraints;

use App\Validator\Constraints\IsValidDateTimeImmutable;
use App\Validator\Constraints\IsValidDateTimeImmutableValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class IsValidDateTimeImmutableValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        return new IsValidDateTimeImmutableValidator();
    }

    public function testValidDateInThePast()
    {
        $constraint = new IsValidDateTimeImmutable([
            'message' => 'The date "{{ string }}" is not a valid DateTimeImmutable object.',
        ]);

        $validPastDate = new \DateTimeImmutable('now');
        $this->validator->validate($validPastDate, $constraint);

        $this->assertNoViolation();
    }

    public function testValidDateInTheFuture()
    {
        $constraint = new IsValidDateTimeImmutable([
            'message' => 'The date "{{ string }}" is not a valid DateTimeImmutable object.',
        ]);

        $validFutureDate = (new \DateTimeImmutable('now'))->sub(new \DateInterval('P1D'));
        $this->validator->validate($validFutureDate, $constraint);

        $this->assertNoViolation();
    }
}
