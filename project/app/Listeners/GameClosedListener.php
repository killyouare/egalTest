<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Exceptions\UpdatingException;

class GameClosedListener extends ListenerModel
{

    /**
     * @throws UpdatingException
     */
    public function handle(EventModel $event): void
    {
        if ($event->getAttribute("winner_id")) {
            throw new UpdatingException("The game is already closed");
        }
    }
}
