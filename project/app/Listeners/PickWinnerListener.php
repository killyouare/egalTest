<?php

namespace App\Listeners;

use App\Abstracts\EventAttributes;
use App\Abstracts\ListenerAttributes;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\UpdatingException;
use App\Helpers\TransactionHelper;
use App\Models\LotteryGameMatch;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class PickWinnerListener extends ListenerAttributes
{

    /**
     * @throws UpdatingException|ModelNotFoundException
     */
    public function handle(EventAttributes $event): void
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
