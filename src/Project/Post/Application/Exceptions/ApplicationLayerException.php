<?php

namespace App\Project\Post\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

abstract class ApplicationLayerException extends \Exception
{
    public function __construct(string $message = "")
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}