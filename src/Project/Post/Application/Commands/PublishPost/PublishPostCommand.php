<?php

namespace App\Project\Post\Application\Commands\PublishPost;

use App\Project\Post\Application\Commands\AbstractCommand;
use App\Project\Post\Domain\PostAggregate;

class PublishPostCommand extends AbstractCommand
{
    public function __construct(protected PostAggregate $postAggregate)
    {
    }

    public function getPostAggregate(): PostAggregate
    {
        return $this->postAggregate;
    }
}