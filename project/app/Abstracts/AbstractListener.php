<?php

namespace App\Abstracts;

abstract class AbstractListener
{

    abstract public function handle(Event $event): void;
}
