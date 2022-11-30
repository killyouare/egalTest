<?php

namespace App\Listeners;

use App\Exceptions\OutOfGameParticipantsCountException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\LotteryGameMatch;

class OutOfGameParticipantsCountListener extends AbstractListener
{

    /**
     * @throws OutOfGameParticipantsCountException
     */
    public function handle(AbstractEvent $event): void
    {
        $lgm = LotteryGameMatch::query()
            ->where([
                'id' => $event->getAttribute('lottery_game_match_id')
            ])
            ->with([
                "game",
                "players"
            ])
            ->first()
            ->toArray();

        if (count($lgm['players']) >= $lgm['game']['gamer_count']) {
            throw new OutOfGameParticipantsCountException();
        }
    }
}
