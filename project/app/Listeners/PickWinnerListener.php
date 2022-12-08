<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Exceptions\UpdatingException;
use App\Models\LotteryGameMatch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PickWinnerListener extends AbstractListenerWithAttributes
{

    /**
     * @throws UpdatingException
     */
    public function handle(AbstractEvent $event): void
    {
        /** @var LotteryGameMatch $lgm */
        $lgm = $event->getModel();

        /** @var Collection $players */
        $players = $lgm->players()
            ->getResults();

        if ($players->count() === 0) {
            DB::rollBack();

            throw new UpdatingException("The game has no members");
        }

        $lgm->setAttribute("winner_id", $players->random()->user_id);
        $lgm->save();
    }
}
