<?php

declare(strict_types=1);

namespace App\Tests\Project\Post\Domain\ValueObjects;

use App\Project\Post\Domain\Constants\ContentConstants;
use App\Project\Post\Domain\ValueObjects\Content;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Mapping\Factory\LazyLoadingMetadataFactory;
use Symfony\Component\Validator\Mapping\Loader\AttributeLoader;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContentTest extends TestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->setMetadataFactory(new LazyLoadingMetadataFactory(new AttributeLoader()))
            ->getValidator();
    }

    public function testContentIsExactlyMinimumLength(): void
    {
        $content = new Content(str_repeat('A', ContentConstants::MIN_LENGTH));
        $violations = $this->validator->validate($content);

        $this->assertCount(0, $violations);
    }

    public function testContentIsExactlyMaximumLength(): void
    {
        $content = new Content(str_repeat('A', ContentConstants::MAX_LENGTH));
        $violations = $this->validator->validate($content);

        $this->assertCount(0, $violations);
    }

    public function testContentIsJustOneCharacterTooShort(): void
    {
        $content = new Content(
            str_repeat('A', ContentConstants::MIN_LENGTH - 1)
        );
        $violations = $this->validator->validate($content);

        $this->assertGreaterThan(0, count($violations));
    }

    public function testContentIsJustOneCharacterTooLong(): void
    {
        $content = new Content(
            str_repeat('A', ContentConstants::MAX_LENGTH + 1)
        );
        $violations = $this->validator->validate($content);

        $this->assertGreaterThan(0, count($violations));
    }
}
