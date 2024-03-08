<?php

namespace App\Project\User\Domain\Exceptions;

use Symfony\Component\HttpFoundation\Response;

abstract class DomainException extends \Exception
{
    public function __construct(string $message = "", int $code = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($message, $code);
    }
}