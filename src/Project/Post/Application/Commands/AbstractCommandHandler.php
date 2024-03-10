<?php

namespace App\Project\Post\Application\Commands;

use App\Project\Post\Domain\Repository\PostRepositoryInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class AbstractCommandHandler
{
    protected LoggerInterface $logger;

    public function __construct(protected readonly PostRepositoryInterface $postRepository)
    {
        $this->logger = new Logger(self::class);
    }
}