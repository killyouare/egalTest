<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\UpdatingException;

class GameClosedListener extends AbstractListenerWithAttributes
{

    /**
     * @throws UpdatingException
     */
    public function handle(AbstractEvent $event): void
    {
        if ($event->getAttribute("winner_id")) {
            throw new UpdatingException("The game is already closed");
        }
    }
}
