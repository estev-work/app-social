<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class IsValidDateTimeImmutableValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof IsValidDateTimeImmutable) {
            throw new UnexpectedTypeException($constraint, IsValidDateTimeImmutable::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof \DateTimeImmutable) {
            throw new UnexpectedValueException($value, \DateTimeImmutable::class);
        }

        if (new \DateTimeImmutable() < $value) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value->format(\DateTimeInterface::ATOM))
                ->addViolation();
        }
    }
}