<?php

namespace App\Tests\Project\User\Domain\ValueObjects;

use App\Project\User\Domain\Constants\UserNameConstants;
use App\Project\User\Domain\ValueObjects\UserName;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;

class UserNameTest extends TestCase
{
    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testUserNameIsExactlyMinimumLength(): void
    {
        $userName = new UserName(str_repeat('A', UserNameConstants::MIN_LENGTH));
        $violations = $this->validator->validate($userName);

        $this->assertCount(0, $violations);
    }

    public function testUserNameIsExactlyMaximumLength(): void
    {
        $userName = new UserName(str_repeat('A', UserNameConstants::MAX_LENGTH));
        $violations = $this->validator->validate($userName);

        $this->assertCount(0, $violations);
    }

    public function testUserNameIsJustOneCharacterTooShort(): void
    {
        $userName = new UserName(
            str_repeat('A', UserNameConstants::MIN_LENGTH - 1)
        );
        $violations = $this->validator->validate($userName);

        $this->assertGreaterThan(0, count($violations));
    }

    public function testUserNameIsJustOneCharacterTooLong(): void
    {
        $userName = new UserName(
            str_repeat('A', UserNameConstants::MAX_LENGTH + 1)
        );
        $violations = $this->validator->validate($userName);

        $this->assertGreaterThan(0, count($violations));
    }
}
