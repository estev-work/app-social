<?php

namespace App\Project\Post\Application\Commands\SaveOrUpdatePost;

final readonly class SaveOrUpdatePostCommand
{
    public function __construct(
        public string $title,
        public string $authorId,
        public string $isPublished
    ) {
    }
}