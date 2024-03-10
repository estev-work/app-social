<?php

namespace App\Project\Post\Application\Events\PostCreationEvent;

use App\Project\Post\Domain\PostAggregate;

readonly class PostCreationEvent
{
    public function __construct(public PostAggregate $postAggregate)
    {
    }

}