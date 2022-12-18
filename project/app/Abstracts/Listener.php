<?php

namespace App\Abstracts;

abstract class Listener
{

    abstract public function handle(Event $event): void;
}
