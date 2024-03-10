<?php

namespace App\Project\Post\Application\Commands\UnpublishPost;

use App\Project\Post\Application\Commands\AbstractCommandHandler;
use App\Project\Post\Domain\PostAggregate;
use Ecotone\Modelling\Attribute\CommandHandler;

class UnpublishPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    #[CommandHandler]
    public function handle(UnpublishPostCommand $command): PostAggregate
    {
        $this->aggregate = $command->postAggregate;
        $this->aggregate->unpublished();
        $this->logger->info("Unpublished {$this->aggregate->getId()}");
        return $this->aggregate;
    }
}