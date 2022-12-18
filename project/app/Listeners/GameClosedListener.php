<?php

namespace App\Listeners;

use App\Abstracts\EventAttributes;
use App\Abstracts\ListenerAttributes;
use App\Exceptions\UpdatingException;

class GameClosedListener extends ListenerAttributes
{

    /**
     * @throws UpdatingException
     */
    public function handle(EventAttributes $event): void
    {
        if ($event->getAttribute("winner_id")) {
            throw new UpdatingException("The game is already closed");
        }
    }
}
