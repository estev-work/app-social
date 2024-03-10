<?php

namespace App\Project\Post\Application\Commands\PublishPost;

use App\Project\Post\Application\Commands\AbstractCommandHandler;
use App\Project\Post\Domain\PostAggregate;
use Ecotone\Modelling\Attribute\CommandHandler;

class PublishPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    #[CommandHandler]
    public function handle(PublishPostCommand $command): PostAggregate
    {
        $command->postAggregate->published();
        $this->logger->info("Published {$command->postAggregate->getId()}");
        return $this->aggregate;
    }
}