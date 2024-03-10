<?php

namespace App\Project\Post\Application;

use App\Project\Post\Application\Commands\CreateNewPost\CreateNewPostCommand;
use App\Project\Post\Application\Commands\PublishPost\PublishPostCommand;
use App\Project\Post\Application\Commands\UnpublishPost\UnpublishPostCommand;
use App\Project\Post\Application\Events\PostCreationEvent\PostCreationEvent;
use App\Project\Post\Application\Queries\GetAllPosts\GetAllPostsQuery;
use App\Project\Post\Domain\PostAggregate;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\EventBus;
use Ecotone\Modelling\QueryBus;

;

class PostFacade
{
    private CommandBus $commandBus;
    private QueryBus $queryBus;
    private EventBus $eventBus;

    public function __construct(
        CommandBus $commandBus,
        QueryBus $queryBus,
        EventBus $eventBus,
    ) {
        $this->commandBus = $commandBus;
        $this->eventBus = $eventBus;
        $this->queryBus = $queryBus;
    }


    #region Commands
    public function createNewPost(string $title, string $content, string $authorId, $isPublished): PostAggregate
    {
        $command = new CreateNewPostCommand($title, $content, $authorId, $isPublished);
        $post = $this->commandBus->send($command);
        $event = new PostCreationEvent($post);
        $this->eventBus->publish($event);
        return $post;
    }

    public function publishPost(PostAggregate $post): PostAggregate
    {
        $command = new PublishPostCommand($post);
        return $this->commandBus->send($command);
    }

    public function unpublishPost(PostAggregate $post): array
    {
        $command = new UnpublishPostCommand($post);
        $result = $this->commandBus->send($command);
        return $result->toArray();
    }

    #endregion
    #region Queries

    /**
     * @return PostAggregate[]|array
     */
    public function getAllPosts(): array
    {
        $query = new GetAllPostsQuery();
        return $this->queryBus->send($query);
    }
    #endregion
}