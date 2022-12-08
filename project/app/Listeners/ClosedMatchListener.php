<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Models\LotteryGameMatch;
use Egal\Model\Exceptions\ValidateException;

class ClosedMatchListener extends AbstractListenerWithAttributes
{

    /**
     * @throws ValidateException
     */
    public function handle(AbstractEvent $event): void
    {
        if (!LotteryGameMatch::query()
            ->where(
                [
                    "id" => $event->getAttribute("lottery_game_match_id"),
                    "winner_id" => null,
                ]
            )->first()) {
            throw new ValidateException();
        }
    }

}
