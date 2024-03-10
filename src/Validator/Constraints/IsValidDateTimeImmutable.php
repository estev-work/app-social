<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class IsValidDateTimeImmutable extends Constraint
{
    public string $message = 'The date "{{ string }}" is not a valid DateTimeImmutable object.';
}