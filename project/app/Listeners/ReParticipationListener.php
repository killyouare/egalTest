<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Exceptions\ValidatedException;
use App\Helpers\SessionHelper;
use App\Models\LotteryGameMatchUser;

class ReParticipationListener extends ListenerModel
{

    /**
     * @throws ValidatedException
     */
    public function handle(EventModel $event): void
    {
        if (LotteryGameMatchUser::query()
            ->where(
                [
                    'user_id' => SessionHelper::getUserId(),
                    'lottery_game_match_id' => $event->getAttribute('lottery_game_match_id')
                ]
            )->first()) {
            throw new ValidatedException("You can't participate twice");
        }
    }
}
