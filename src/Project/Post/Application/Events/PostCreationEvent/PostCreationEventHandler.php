<?php

namespace App\Project\Post\Application\Events\PostCreationEvent;

use App\Project\Post\Application\Events\AbstractEventHandler;
use App\Project\Post\Domain\EventHandlers\EventsEnum;
use Ecotone\Modelling\Attribute\EventHandler;

class PostCreationEventHandler extends AbstractEventHandler
{
    #[EventHandler]
    public function handle(PostCreationEvent $event): void
    {
        $this->eventPublisher->publish(
            EventsEnum::postCreated,
            $event->postAggregate->toArray()
        );
        $this->logger->info('Событие: Post с id' . $event->postAggregate->getId() . ' создан.');
    }
}