<?php

namespace App\Project\Post\Application\Commands\CreateNewPost;

final readonly class CreateNewPostCommand
{
    public function __construct(
        public string $title,
        public string $content,
        public string $authorId,
        public string $isPublished
    ) {
    }

}