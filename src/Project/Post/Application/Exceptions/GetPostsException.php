<?php

namespace App\Project\Post\Application\Exceptions;

class GetPostsException extends ApplicationLayerException
{
    public function __construct()
    {
        parent::__construct("Не удалось получить посты");
    }
}