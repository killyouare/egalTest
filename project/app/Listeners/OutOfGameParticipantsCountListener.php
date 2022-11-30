<?php

namespace App\Listeners;

use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\LotteryGameMatch;


class OutOfGameParticipantsCountListener extends AbstractListener
{

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
            ->get()
            ->toArray()[0];

        if (count($lgm['players']) >= $lgm['game']['gamer_count']){
            # TODO: сделать нормальный exception
            throw new \Exception();
        }
    }
}
