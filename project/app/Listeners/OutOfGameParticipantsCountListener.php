<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\IEvent;
use App\Abstracts\ListenerModel;
use App\Exceptions\ValidatedException;
use App\Models\LotteryGameMatch;

class OutOfGameParticipantsCountListener extends ListenerModel
{

    /**
     * @throws ValidatedException
     */
    public function handle(EventModel $event): void
    {
        $lgm = LotteryGameMatch::query()
            ->where(
                [
                    'id' => $event->getAttribute('lottery_game_match_id')
                ]
            )->with(
                [
                    "game",
                    "players"
                ]
            )->first()
            ->toArray();

        if (count($lgm['players']) >= $lgm['game']['gamer_count']) {
            throw new ValidatedException("All places are filled");
        }
    }
}
