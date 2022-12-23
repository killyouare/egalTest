<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\UpdatingException;

class ClosingMatchBeforeStartListener extends ListenerModel
{

    /**
     * @throws UpdatingException|ModelNotFoundException
     */
    public function handle(EventModel $event): void
    {
        if ($event->getModel()
            ->isGameStarted()) {
            throw new UpdatingException("You can't close a match before it starts");
        }
    }
}
