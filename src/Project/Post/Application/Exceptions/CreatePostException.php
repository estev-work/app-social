<?php

namespace App\Project\Post\Application\Exceptions;

class CreatePostException extends ApplicationLayerException
{
    public function __construct()
    {
        parent::__construct("Не удалось создать пост");
    }
}