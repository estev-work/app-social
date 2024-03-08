<?php

namespace App\Project\Post\Domain;

interface AggregateRootInterface
{
    public function toArray(): array;
}