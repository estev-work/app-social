<?php

declare(strict_types=1);

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\Constants\TitleConstants;
use App\Project\Post\Domain\ValueObjects\Title;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TitleTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testTitleIsExactlyMinimumLength(): void
    {
        $title = new Title(str_repeat('A', TitleConstants::MIN_LENGTH));
        $violations = $this->validator->validate($title);

        $this->assertCount(0, $violations);
    }

    public function testTitleIsExactlyMaximumLength(): void
    {
        $title = new Title(str_repeat('A', TitleConstants::MAX_LENGTH));
        $violations = $this->validator->validate($title);

        $this->assertCount(0, $violations);
    }

    public function testTitleIsJustOneCharacterTooShort(): void
    {
        $title = new Title(
            str_repeat('A', TitleConstants::MIN_LENGTH - 1)
        );
        $violations = $this->validator->validate($title);

        $this->assertGreaterThan(0, count($violations));
    }

    public function testTitleIsJustOneCharacterTooLong(): void
    {
        $title = new Title(
            str_repeat('A', TitleConstants::MAX_LENGTH + 1)
        );
        $violations = $this->validator->validate($title);

        $this->assertGreaterThan(0, count($violations));
    }


    public function testTitleGetValue(): void
    {
        $title = new Title(str_repeat('A', TitleConstants::MIN_LENGTH));
        $violations = $this->validator->validate($title);
        $this->assertCount(0, $violations);
        $this->assertEquals(str_repeat('A', TitleConstants::MIN_LENGTH), $title->getValue());
    }
}
