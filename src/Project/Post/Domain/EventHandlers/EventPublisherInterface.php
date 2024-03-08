<?php

namespace App\Project\Post\Domain\EventHandlers;

interface EventPublisherInterface
{
    function publish(EventsEnum $event, $message): void;
}