<?php

namespace App\Abstracts;

abstract class ListenerModel
{

    abstract public function handle(EventModel $event): void;
}
