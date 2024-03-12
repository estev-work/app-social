<?php

declare(strict_types=1);

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\ValueObjects\UpdatedDate;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdatedDateTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testUpdatedDateIsValid(): void
    {
        $updatedDate = new UpdatedDate('now');
        $violations = $this->validator->validate($updatedDate);
        $this->assertCount(0, $violations);
    }

    public function testUpdatedDateIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new UpdatedDate("invalid date time string");
    }

    public function testUpdatedDateToISO(): void
    {
        $updatedDate = new UpdatedDate('2021-01-01T00:00:00+00:00');
        $this->assertEquals('2021-01-01T00:00:00+00:00', $updatedDate->toISO());
    }

    public function testUpdatedDateToISOWithDefault(): void
    {
        $updatedDate = new UpdatedDate();
        $this->assertEquals(date('Y-m-d\TH:i:sP'), $updatedDate->toISO());
    }

    public function testUpdatedDateGetValue(): void
    {
        $updatedDate = new UpdatedDate('2021-01-01T00:00:00+00:00');
        $this->assertEquals('2021-01-01T00:00:00+00:00', $updatedDate->getValue()->format(DATE_ATOM));
    }

    public function testUpdatedDateGetValueWithDefault(): void
    {
        $updatedDate = new UpdatedDate();
        $this->assertEquals(date(DATE_ATOM), $updatedDate->getValue()->format(DATE_ATOM));
    }

    public function testUpdatedDateGetValueWithCustomDate(): void
    {
        $updatedDate = new UpdatedDate('2021-01-01');
        $this->assertEquals('2021-01-01T00:00:00+00:00', $updatedDate->getValue()->format(DATE_ATOM));
    }
}
