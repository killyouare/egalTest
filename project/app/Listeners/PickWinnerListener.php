<?php

namespace App\Listeners;

use App\Exceptions\NoMembersException;
use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Models\LotteryGameMatch;

class PickWinnerListener extends AbstractListener
{

    /**
     * @throws NoMembersException
     */
    public function handle(AbstractEvent $event): void
    {
        /** @var LotteryGameMatch $lgm */
        $lgm = $event->getModel();

        /** @var \Illuminate\Database\Eloquent\Collection $players */
        $players = $lgm->players()
            ->getResults();

        if (!$players->count()) {
            throw new NoMembersException();
        }

        $lgm->setAttribute("winner_id", $players->random()->user_id);
        $lgm->save();
    }
}
