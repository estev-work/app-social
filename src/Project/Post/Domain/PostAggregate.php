<?php

namespace App\Project\Post\Domain;

use App\Project\Post\Domain\Exceptions\DomainTitleValidationException;
use App\Project\Post\Domain\ValueObjects\AuthorId;
use App\Project\Post\Domain\ValueObjects\Content;
use App\Project\Post\Domain\ValueObjects\CreatedDate;
use App\Project\Post\Domain\ValueObjects\PostId;
use App\Project\Post\Domain\ValueObjects\PublishedStatus;
use App\Project\Post\Domain\ValueObjects\Title;
use App\Project\Post\Domain\ValueObjects\UpdatedDate;
use Exception;

class PostAggregate implements AggregateRootInterface, PostAggregateInterface
{
    protected PostId $id;
    protected Title $title;
    protected Content $content;
    protected AuthorId $author;
    protected PublishedStatus $published;
    protected CreatedDate $createdAt;
    protected UpdatedDate $updatedAt;

    /**
     * @param PostId $id
     * @param Title $title
     * @param Content $content
     * @param AuthorId $author
     * @param PublishedStatus $published
     * @param CreatedDate $createdAt
     * @param UpdatedDate $updatedAt
     */
    public function __construct(
        PostId $id,
        Title $title,
        Content $content,
        AuthorId $author,
        PublishedStatus $published,
        CreatedDate $createdAt,
        UpdatedDate $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->published = $published;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function make(
        string $postId = null,
        string $title = null,
        string $content = null,
        string $authorId = null,
        bool $isPublished = null,
        string $createdAt = null,
        string $updatedAt = null
    ): self {
        return new PostAggregate(
            new PostId($postId),
            new Title($title),
            new Content($content),
            new AuthorId($authorId),
            new PublishedStatus($isPublished),
            new CreatedDate($createdAt),
            new UpdatedDate($updatedAt),
        );
    }

    #region FUNCTIONS

    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'title' => $this->title->getValue(),
            'content' => $this->content->getValue(),
            'author' => $this->author->getValue(),
            'published' => $this->published->getValue(),
            'createdAt' => $this->createdAt->toISO(),
            'updatedAt' => $this->updatedAt?->toISO(),
        ];
    }

    public function getId(): string
    {
        return $this->id->getValue();
    }

    /**
     * @throws DomainTitleValidationException|Exception
     */
    public function changeTitle(string $newTitle): self
    {
        $this->title->change($newTitle);
        return $this;
    }

    public function published(): self
    {
        $this->published->published();
        return $this;
    }

    public function unpublished(): self
    {
        $this->published->unpublished();
        return $this;
    }
    #endregion

    #region GETTERS
    public function getCreatedAt(): CreatedDate
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedDate
    {
        return $this->updatedAt;
    }

    public function getTitle(): string
    {
        return $this->title->getValue();
    }

    public function getAuthor(): string
    {
        return $this->author->getValue();
    }

    public function getPublished(): bool
    {
        return $this->published->getValue();
    }

    public function getContent(): string
    {
        return $this->content->getValue();
    }
    #endregion
}