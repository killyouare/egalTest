<?php

namespace App\Listeners;

use App\Exceptions\ClosingMatchBeforeStartException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;

class ClosingMatchBeforeStartListener extends AbstractListener
{

    /**
     * @throws ClosingMatchBeforeStartException
     */
    public function handle(AbstractEvent $event): void
    {
        if ($event->getModel()
            ->isGameStarted()) {
            throw new ClosingMatchBeforeStartException();
        }
    }
}
