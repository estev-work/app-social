<?php

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\ValueObjects\PostId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostIdTest extends TestCase
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
        $postId = new PostId($uuid);
        $this->assertEquals($uuid, $postId->getValue());
    }

    public function testAuthorIdIsNotValidUuid(): void
    {
        $uuid = 'not-valid-uuid';
        $postId = new PostId($uuid);
        $violations = $this->validator->validate($postId);
        $this->assertCount(1, $violations);
    }

    public function testAuthorIdIsEmptyUuid(): void
    {
        $uuid = '';
        $postId = new PostId($uuid);
        $violations = $this->validator->validate($postId);
        $this->assertCount(0, $violations);
    }

    public function testAuthorIdIsNullUuid(): void
    {
        $postId = new PostId(null);
        $violations = $this->validator->validate($postId);
        $this->assertTrue($this->checkValidUuid($postId->getValue()));
        $this->assertCount(0, $violations);
    }

    public function testAuthorIdIsNotProvidedUuid(): void
    {
        $postId = new PostId();
        $violations = $this->validator->validate($postId);
        $this->assertTrue($this->checkValidUuid($postId->getValue()));
        $this->assertCount(0, $violations);
    }

    private function checkValidUuid(string $uuid): bool
    {
        return Uuid::isValid($uuid);
    }
}
