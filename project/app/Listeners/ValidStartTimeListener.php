<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\CreatingException;
use Carbon\Carbon;

class ValidStartTimeListener extends AbstractListenerWithAttributes
{

    /**
     * @throws CreatingException
     */
    public function handle(AbstractEvent $event): void
    {
        if (
            Carbon::now()->toDateString() === $event->getAttribute("start_date")
            && !$event->getModel()->isGameStarted()
        ) {
            throw new CreatingException("You cannot create a game that starts earlier than now");
        }
    }
}
