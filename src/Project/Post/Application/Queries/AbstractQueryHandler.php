<?php

namespace App\Project\Post\Application\Queries;

use App\Project\Post\Domain\Repository\PostRepositoryInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class AbstractQueryHandler
{
    protected LoggerInterface $logger;

    public function __construct(protected readonly PostRepositoryInterface $postRepository)
    {
        $this->logger = new Logger(self::class);
    }

    abstract public function handle(AbstractQuery $query);
}