<?php

namespace App\Listeners;

use App\Exceptions\ClosingMatchBeforeStartException;
use App\Exceptions\CreateGameException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use Carbon\Carbon;

class ValidStartTimeListener extends AbstractListener
{

    /**
     * @throws CreateGameException
     */
    public function handle(AbstractEvent $event): void
    {
        if (
            Carbon::now()->toDateString() === $event->getAttribute("start_date")
            && !$event->getModel()->isGameStarted()
        ) {
            throw new CreateGameException();
        }
    }
}
