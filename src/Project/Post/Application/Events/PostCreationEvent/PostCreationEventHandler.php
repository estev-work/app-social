<?php

namespace App\Project\Post\Application\Events\PostCreationEvent;

use App\Project\Post\Application\Events\AbstractEvent;
use App\Project\Post\Application\Events\AbstractEventHandler;
use App\Project\Post\Domain\EventHandlers\EventsEnum;

class PostCreationEventHandler extends AbstractEventHandler
{

    public function handle(PostCreationEvent|AbstractEvent $event): void
    {
        $this->eventPublisher->publish(
            EventsEnum::postCreated,
            $event->getPostAggregate()->toArray()
        );
        $this->logger->info('Событие: Post с id' . $event->getPostAggregate()->getId() . ' создан.');
    }
}