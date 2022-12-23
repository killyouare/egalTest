<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Exceptions\UpdatingException;
use App\Helpers\TransactionHelper;
use App\Models\LotteryGameMatch;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class PickWinnerListener extends ListenerModel
{

    /**
     * @throws UpdatingException
     */
    public function handle(EventModel $event): void
    {
        /** @var LotteryGameMatch $lgm */
        $lgm = $event->getModel();

        /** @var Collection $players */
        $players = $lgm->players()
            ->getResults();

        if ($players->count() === 0) {
            throw new UpdatingException("The game has no members");
        }

        try {
            $lgm->setAttribute("winner_id", $players->random()->user_id);

            $lgm->save();
        } catch (Exception) {
            TransactionHelper::rollback();

            throw new UpdatingException("can't pick a winner");
        }
    }
}
