<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\ValidatedException;
use App\Models\LotteryGameMatch;

class RegistrationForTheMatchBeforeStartListener extends AbstractListenerWithAttributes
{

    /**
     * @throws ValidatedException
     */
    public function handle(AbstractEvent $event): void
    {
        if (
            LotteryGameMatch::query()
                ->find($event->getAttribute("lottery_game_match_id"))
                ->isGameStarted()
        ) {
            throw new ValidatedException("You cannot register for a match before it starts.");
        }
    }
}
