<?php

namespace App;

readonly class ActivateFooCommand
{
    public function __construct(public string $identifier)
    {
    }
}
