<?php

namespace App\Project\Post\Application\Commands\UnpublishPost;

use App\Project\Post\Domain\PostAggregate;

final readonly class UnpublishPostCommand
{
    public function __construct(public PostAggregate $postAggregate)
    {
    }
}