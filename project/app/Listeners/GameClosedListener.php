<?php

namespace App\Listeners;

use App\Exceptions\GameClosedException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;

class GameClosedListener extends AbstractListener
{

    /**
     * @throws GameClosedException
     */
    public function handle(AbstractEvent $event): void
    {
        if ($event->getAttribute("winner_id")) {
            throw new GameClosedException();
        }
    }
}
