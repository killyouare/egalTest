<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\UpdatingException;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddPointsListener extends AbstractListenerWithAttributes
{

    /**
     * @throws UpdatingException
     */
    public function handle(AbstractEvent $event): void
    {
        /** @var LotteryGameMatch $lgm */
        $lgm = $event->getModel();

        if (!$lgm->getAttribute('winner_id')) {
            DB::rollBack();

            throw new UpdatingException("Winner not found");
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
