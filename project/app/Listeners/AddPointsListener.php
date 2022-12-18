<?php

namespace App\Listeners;

use App\Abstracts\EventAttributes;
use App\Abstracts\IEvent;
use App\Abstracts\IEventWithAttributes;
use App\Abstracts\ListenerAttributes;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\UpdatingException;
use App\Helpers\TransactionHelper;
use App\Models\LotteryGameMatch;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class AddPointsListener extends ListenerAttributes
{

    /**
     * @throws UpdatingException|ModelNotFoundException
     * @throws Exception
     */
    public function handle(EventAttributes $event): void
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

        try {
            $user->setAttribute("points", $user->getAttribute("points") + $rewardPoints);
            $user->save();
        } catch (Exception) {
            TransactionHelper::rollback();

            throw new UpdatingException("can't pick a winner");
        }
    }
}
