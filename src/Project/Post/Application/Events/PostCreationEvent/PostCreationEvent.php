<?php

namespace App\Project\Post\Application\Events\PostCreationEvent;

use App\Project\Post\Application\Events\AbstractEvent;
use App\Project\Post\Domain\PostAggregate;

class PostCreationEvent extends AbstractEvent
{
    public function __construct(protected PostAggregate $postAggregate)
    {
    }

    public function getPostAggregate(): PostAggregate
    {
        return $this->postAggregate;
    }

}