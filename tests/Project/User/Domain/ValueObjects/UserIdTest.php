<?php

namespace App\Tests\Project\User\Domain\ValueObjects;

use App\Project\User\Domain\ValueObjects\UserId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserIdTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testUserIdIsValidUuid(): void
    {
        $uuid = Uuid::v4();
        $userId = new UserId($uuid);
        $this->assertEquals($uuid, $userId->getValue());
    }

    public function testUserIdIsNotValidUuid(): void
    {
        $uuid = 'not-valid-uuid';
        $userId = new UserId($uuid);
        $violations = $this->validator->validate($userId);
        $this->assertCount(1, $violations);
    }

    public function testUserIdIsEmptyUuid(): void
    {
        $uuid = '';
        $userId = new UserId($uuid);
        $violations = $this->validator->validate($userId);
        $this->assertCount(0, $violations);
    }

    public function testUserIdIsNullUuid(): void
    {
        $userId = new UserId(null);
        $violations = $this->validator->validate($userId);
        $this->assertTrue($this->checkValidUuid($userId->getValue()));
        $this->assertCount(0, $violations);
    }

    public function testUserIdIsNotProvidedUuid(): void
    {
        $userId = new UserId();
        $violations = $this->validator->validate($userId);
        $this->assertTrue($this->checkValidUuid($userId->getValue()));
        $this->assertCount(0, $violations);
    }

    private function checkValidUuid(string $uuid): bool
    {
        return Uuid::isValid($uuid);
    }
}
