<?php

namespace App\Project\Post\Domain\ValueObjects;

use App\Validator\Constraints as AppAssert;
use DateTimeImmutable;
use DateTimeInterface;

final readonly class UpdatedDate
{
    #[AppAssert\IsValidDateTimeImmutable]
    private DateTimeImmutable $value;

    public function __construct(?string $updatedDate = 'now')
    {
        try {
            $this->value = new DateTimeImmutable($updatedDate);
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