<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\IEvent;
use App\Abstracts\ListenerModel;
use App\Exceptions\CreatingException;
use Carbon\Carbon;

class ValidStartTimeListener extends ListenerModel
{

    /**
     * @throws CreatingException
     */
    public function handle(EventModel $event): void
    {
        if (
            Carbon::now()->toDateString() === $event->getAttribute("start_date")
            && !$event->getModel()->isGameStarted()
        ) {
            throw new CreatingException("You cannot create a game that starts earlier than now");
        }
    }
}
