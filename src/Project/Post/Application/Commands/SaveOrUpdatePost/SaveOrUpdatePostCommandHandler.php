<?php

namespace App\Project\Post\Application\Commands\SaveOrUpdatePost;

use App\Project\Post\Application\Commands\AbstractCommand;
use App\Project\Post\Application\Commands\AbstractCommandHandler;
use App\Project\Post\Domain\PostAggregate;

class SaveOrUpdatePostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(SaveOrUpdatePostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = PostAggregate::make(
            title: $command->getTitle(),
            authorId: $command->getAuthorId(),
            isPublished: $command->getIsPublished()
        );
        $this->logger->info("Created new post {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}