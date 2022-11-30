<?php

namespace App\Listeners;

use App\Exceptions\GameClosedException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\LotteryGameMatch;

class ClosedMatchListener extends AbstractListener
{

    /**
     * @throws GameClosedException
     */
    public function handle(AbstractEvent $event): void
    {
        if (!LotteryGameMatch::query()
            ->where([
                "id" => $event->getAttribute("lottery_game_match_id"),
                "winner_id" => null
            ])->first()) {
            throw new GameClosedException();
        }
    }

}
