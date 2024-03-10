<?php

namespace App\Project\Post\Application\Commands\CreateNewPost;

use App\Project\Post\Application\Commands\AbstractCommandHandler;
use App\Project\Post\Application\Exceptions\ApplicationLayerException;
use App\Project\Post\Application\Exceptions\CreatePostException;
use App\Project\Post\Domain\PostAggregate;
use Ecotone\Modelling\Attribute\CommandHandler;
use Exception;

class CreateNewPostCommandHandler extends AbstractCommandHandler
{
    protected PostAggregate $aggregate;

    /**
     * @throws ApplicationLayerException
     * @throws Exception
     */
    #[CommandHandler]
    public function handle(CreateNewPostCommand $command): PostAggregate
    {
        $this->aggregate = PostAggregate::make(
            title: $command->title,
            content: $command->content,
            authorId: $command->authorId,
            isPublished: $command->isPublished
        );
        try {
            $this->postRepository->savePost($this->aggregate);
        } catch (Exception $exception) {
            throw new CreatePostException();
        }
        $this->logger->info("Created new post " . $this->aggregate->getId());
        return $this->aggregate;
    }
}