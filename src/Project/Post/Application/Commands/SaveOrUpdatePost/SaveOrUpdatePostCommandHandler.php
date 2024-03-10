<?php

namespace App\Project\Post\Application\Commands\SaveOrUpdatePost;

use App\Project\Post\Application\Commands\AbstractCommandHandler;
use App\Project\Post\Domain\PostAggregate;

class SaveOrUpdatePostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(SaveOrUpdatePostCommand $command): PostAggregate
    {
        $this->aggregate = PostAggregate::make(
            title: $command->title,
            authorId: $command->authorId,
            isPublished: $command->isPublished
        );
        $this->logger->info("Created new post {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}