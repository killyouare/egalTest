<?php

namespace App\Listeners;

use App\Exceptions\ReParticipationException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Helpers\SessionHelper;
use App\Models\LotteryGameMatchUser;

class ReParticipationListener extends AbstractListener
{

    /**
     * @throws ReParticipationException
     */
    public function handle(AbstractEvent $event): void
    {
        $name = 'lottery_game_match_id';

        if (LotteryGameMatchUser::query()
            ->where([
                'user_id' => SessionHelper::getUserId(),
                $name => $event->getAttribute($name)
            ])->first()) {
            throw new ReParticipationException();
        }
    }
}
