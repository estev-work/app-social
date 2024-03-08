<?php

namespace App\Project\Post\Application\Commands\UnpublishPost;

use App\Project\Post\Application\Commands\AbstractCommand;
use App\Project\Post\Application\Commands\AbstractCommandHandler;
use App\Project\Post\Domain\PostAggregate;

class UnpublishPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    public function handle(UnpublishPostCommand|AbstractCommand $command): PostAggregate
    {
        $this->aggregate = $command->getPostAggregate();
        $this->aggregate->unpublished();
        $this->logger->info("Unpublished {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}