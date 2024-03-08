<?php

namespace App\Project\Post\Application\Events;

use App\Project\Post\Domain\EventHandlers\EventPublisherInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

abstract class AbstractEventHandler
{
    protected LoggerInterface $logger;

    public function __construct(protected readonly EventPublisherInterface $eventPublisher)
    {
        $this->logger = new Logger(self::class);
    }

    abstract public function handle(AbstractEvent $event): void;
}