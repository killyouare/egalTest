<?php

namespace App\Listeners;

use App\Exceptions\WinnerNotFoundException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\LotteryGameMatch;
use App\Models\User;

class AddPointsListener extends AbstractListener
{

    /**
     * @throws WinnerNotFoundException
     */
    public function handle(AbstractEvent $event): void
    {
        /** @var LotteryGameMatch $lgm */
        $lgm = $event->getModel();

        if (!$lgm->getAttribute('winner_id')) {
            throw new WinnerNotFoundException();
        }

        /** @var int $rewardPoints */
        $rewardPoints = $lgm->game()
            ->getResults()
            ->getAttribute("reward_points");

        /** @var User $user */
        $user = $lgm->winner()
            ->getResults();

        $user->setAttribute("points", $user->getAttribute("points") + $rewardPoints);

        $user->save();
    }
}
