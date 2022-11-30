<?php
/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CreatingLotteryGameMatchUserEvent;
use App\Events\UpdatingLotteryGameMatchEvent;
use App\Events\ValidatedLotteryGameMatchUserEvent;
use App\Listeners\AddPointsListener;
use App\Listeners\AddUserToModelListener;
use App\Listeners\ClosedMatchListener;
use App\Listeners\CloseRequestValidationListener;
use App\Listeners\GameClosedListener;
use App\Listeners\OutOfGameParticipantsCountListener;
use App\Listeners\PickWinnerListener;
use App\Listeners\ReParticipationListener;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        ValidatedLotteryGameMatchUserEvent::class => [
            ClosedMatchListener::class,
            ReParticipationListener::class,
            OutOfGameParticipantsCountListener::class,
        ],
        CreatingLotteryGameMatchUserEvent::class => [
            AddUserToModelListener::class
        ],
        UpdatingLotteryGameMatchEvent::class => [
            CloseRequestValidationListener::class,
            GameClosedListener::class,
            PickWinnerListener::class,
            AddPointsListener::class
        ]
    ];
}
