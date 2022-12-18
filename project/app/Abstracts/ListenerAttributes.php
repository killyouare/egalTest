<?php

namespace App\Abstracts;

abstract class ListenerAttributes
{

    abstract public function handle(EventAttributes $event): void;
}
