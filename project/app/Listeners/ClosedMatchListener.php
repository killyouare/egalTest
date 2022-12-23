<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Models\LotteryGameMatch;
use Egal\Model\Exceptions\ValidateException;

class ClosedMatchListener extends ListenerModel
{

    /**
     * @throws ValidateException
     */
    public function handle(EventModel $event): void
    {
        if (!LotteryGameMatch::query()
            ->where(
                [
                    "id" => $event->getAttribute("lottery_game_match_id"),
                    "winner_id" => null,
                ]
            )->first()) {
            throw new ValidateException();
        }
    }
}
