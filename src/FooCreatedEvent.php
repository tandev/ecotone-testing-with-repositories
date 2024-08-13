<?php

namespace App;

class FooCreatedEvent
{
    public function __construct(public string $identifier)
    {
    }
}
