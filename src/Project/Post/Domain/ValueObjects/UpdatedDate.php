<?php

namespace App\Project\Post\Domain\ValueObjects;

use App\Validator\Constraints as AppAssert;
use DateTimeImmutable;
use DateTimeInterface;

final class UpdatedDate
{
    #[AppAssert\IsValidDateTimeImmutable]
    private DateTimeImmutable $value;

    public function __construct(?string $createdDate = 'now')
    {
        try {
            $this->value = new DateTimeImmutable($createdDate);
        } catch (\Exception $exception) {
            throw new \InvalidArgumentException($exception->getMessage());
        }
    }

    public function getValue(): DateTimeInterface
    {
        return $this->value;
    }

    public function toISO(): string
    {
        return $this->value->format(DateTimeInterface::ATOM);
    }
}