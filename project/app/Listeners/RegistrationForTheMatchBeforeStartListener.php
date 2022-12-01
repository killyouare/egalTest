<?php

namespace App\Listeners;

use App\Exceptions\RegistrationForTheMatchBeforeStartException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\LotteryGameMatch;

class RegistrationForTheMatchBeforeStartListener extends AbstractListener
{

    /**
     * @throws RegistrationForTheMatchBeforeStartException
     */
    public function handle(AbstractEvent $event): void
    {
        if (LotteryGameMatch::query()
            ->find($event->getAttribute("lottery_game_match_id"))
            ->isGameStarted()
        ) {
            throw new RegistrationForTheMatchBeforeStartException();
        }
    }
}
