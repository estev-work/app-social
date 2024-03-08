<?php

namespace App\Project\Post\Application\Queries\GetAllPosts;

use App\Project\Post\Application\Exceptions\ApplicationLayerException;
use App\Project\Post\Application\Exceptions\GetPostsException;
use App\Project\Post\Application\Queries\AbstractQuery;
use App\Project\Post\Application\Queries\AbstractQueryHandler;
use App\Project\Post\Domain\PostAggregate;
use Exception;

class GetAllPostsQueryHandler extends AbstractQueryHandler
{
    /** @var PostAggregate[] $aggregates */
    protected array $aggregates;

    /**
     * @throws ApplicationLayerException
     * @throws Exception
     */
    public function handle(GetAllPostsQuery|AbstractQuery $query): array
    {
        //TODO Сделать пагинацию
        try {
            $this->aggregates = $this->postRepository->getPosts();
        } catch (Exception $exception) {
            throw new GetPostsException();
        }
        $this->logger->info("Получены все посты");
        return $this->aggregates;
    }
}