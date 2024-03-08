<?php

namespace App\Project\User\Domain;

interface AggregateRootInterface
{
    public function toArray(): array;
}