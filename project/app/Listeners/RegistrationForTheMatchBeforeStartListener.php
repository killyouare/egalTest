<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Exceptions\ValidatedException;
use App\Models\LotteryGameMatch;

class RegistrationForTheMatchBeforeStartListener extends ListenerModel
{

    /**
     * @throws ValidatedException
     */
    public function handle(EventModel $event): void
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
