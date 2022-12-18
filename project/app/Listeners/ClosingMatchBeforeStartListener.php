<?php

namespace App\Listeners;

use App\Abstracts\EventAttributes;
use App\Abstracts\ListenerAttributes;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\UpdatingException;

class ClosingMatchBeforeStartListener extends ListenerAttributes
{

    /**
     * @throws UpdatingException|ModelNotFoundException
     */
    public function handle(EventAttributes $event): void
    {
        if ($event->getModel()
            ->isGameStarted()) {
            throw new UpdatingException("You can't close a match before it starts");
        }
    }
}
