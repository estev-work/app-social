<?php

namespace App\Project\Post\Application\Commands\PublishPost;

use App\Project\Post\Domain\PostAggregate;

final readonly class PublishPostCommand
{
    public function __construct(public PostAggregate $postAggregate)
    {
    }
}