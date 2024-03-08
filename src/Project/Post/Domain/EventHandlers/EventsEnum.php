<?php

namespace App\Project\Post\Domain\EventHandlers;

enum EventsEnum:string
{
    case postCreated = "POST_CREATED";
    case postUpdated = "POST_UPDATED";
    case postDeleted = "POST_DELETED";
}
