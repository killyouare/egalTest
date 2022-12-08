<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\ValidatedException;
use App\Helpers\SessionHelper;
use App\Models\LotteryGameMatchUser;

class ReParticipationListener extends AbstractListenerWithAttributes
{

    /**
     * @throws ValidatedException
     */
    public function handle(AbstractEvent $event): void
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
