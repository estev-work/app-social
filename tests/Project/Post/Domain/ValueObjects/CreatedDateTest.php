<?php

declare(strict_types=1);

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\ValueObjects\CreatedDate;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreatedDateTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testCreatedDateIsValid(): void
    {
        $createdDate = new CreatedDate('now');
        $violations = $this->validator->validate($createdDate);
        $this->assertCount(0, $violations);
    }

    public function testCreatedDateIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new CreatedDate("invalid date time string");
    }

    public function testCreatedDateToISO(): void
    {
        $createdDate = new CreatedDate('2021-01-01T00:00:00+00:00');
        $this->assertEquals('2021-01-01T00:00:00+00:00', $createdDate->toISO());
    }

    public function testCreatedDateToISOWithDefault(): void
    {
        $createdDate = new CreatedDate();
        $this->assertEquals(date('Y-m-d\TH:i:sP'), $createdDate->toISO());
    }

    public function testCreatedDateGetValue(): void
    {
        $createdDate = new CreatedDate('2021-01-01T00:00:00+00:00');
        $this->assertEquals('2021-01-01T00:00:00+00:00', $createdDate->getValue()->format(DATE_ATOM));
    }

    public function testCreatedDateGetValueWithDefault(): void
    {
        $createdDate = new CreatedDate();
        $this->assertEquals(date(DATE_ATOM), $createdDate->getValue()->format(DATE_ATOM));
    }

    public function testCreatedDateGetValueWithCustomDate(): void
    {
        $createdDate = new CreatedDate('2021-01-01');
        $this->assertEquals('2021-01-01T00:00:00+00:00', $createdDate->getValue()->format(DATE_ATOM));
    }
}
