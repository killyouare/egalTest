<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\UpdatingException;

class ClosingMatchBeforeStartListener extends AbstractListenerWithAttributes
{

    /**
     * @throws UpdatingException
     */
    public function handle(AbstractEvent $event): void
    {
        if ($event->getModel()
            ->isGameStarted()) {
            throw new UpdatingException("You can't close a match before it starts");
        }
    }
}
