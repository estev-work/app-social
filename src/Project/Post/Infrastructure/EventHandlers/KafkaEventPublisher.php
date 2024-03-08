<?php

namespace App\Project\Post\Infrastructure\EventHandlers;

use App\Project\Post\Domain\EventHandlers\EventPublisherInterface;
use App\Project\Post\Domain\EventHandlers\EventsEnum;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class KafkaEventPublisher implements EventPublisherInterface
{
    protected LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
    }

    public function publish(EventsEnum $event, $message): void
    {
        $this->logger->debug('!!!!!!!!!!');
    }
}