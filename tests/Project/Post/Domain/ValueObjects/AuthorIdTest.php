<?php

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\ValueObjects\AuthorId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthorIdTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testAuthorIdIsValidUuid(): void
    {
        $uuid = Uuid::v4();
        $authorId = new AuthorId($uuid);
        $this->assertEquals($uuid, $authorId->getValue());
    }

    public function testAuthorIdIsNotValidUuid(): void
    {
        $uuid = 'not-valid-uuid';
        $authorId = new AuthorId($uuid);
        $violations = $this->validator->validate($authorId);
        $this->assertCount(1, $violations);
    }

    public function testAuthorIdIsEmptyUuid(): void
    {
        $uuid = '';
        $authorId = new AuthorId($uuid);
        $violations = $this->validator->validate($authorId);
        $this->assertCount(1, $violations);
    }
}
