<?php
/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\CreatingLotteryGameMatchEvent;
use App\Events\CreatingLotteryGameMatchUserEvent;
use App\Events\UpdatingLotteryGameMatchEvent;
use App\Events\ValidatedLotteryGameMatchUserEvent;
use App\Listeners\AddPointsListener;
use App\Listeners\AddUserToModelListener;
use App\Listeners\BeginTransactionListener;
use App\Listeners\ClosedMatchListener;
use App\Listeners\ClosingMatchBeforeStartListener;
use App\Listeners\CommitTransactionListener;
use App\Listeners\GameClosedListener;
use App\Listeners\LockTableLotteryGameMatchUserInExclusiveModeListener;
use App\Listeners\OutOfGameParticipantsCountListener;
use App\Listeners\PickWinnerListener;
use App\Listeners\RegistrationForTheMatchBeforeStartListener;
use App\Listeners\ReParticipationListener;
use App\Listeners\ValidStartTimeListener;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        CreatingLotteryGameMatchEvent::class => [
            ValidStartTimeListener::class,
        ],
        ValidatedLotteryGameMatchUserEvent::class => [
            RegistrationForTheMatchBeforeStartListener::class,
            ClosedMatchListener::class,
            ReParticipationListener::class,
            BeginTransactionListener::class,
            LockTableLotteryGameMatchUserInExclusiveModeListener::class,
            OutOfGameParticipantsCountListener::class,
            CommitTransactionListener::class,
        ],
        CreatingLotteryGameMatchUserEvent::class => [
            AddUserToModelListener::class
        ],
        UpdatingLotteryGameMatchEvent::class => [
            ClosingMatchBeforeStartListener::class,
            GameClosedListener::class,
            BeginTransactionListener::class,
            PickWinnerListener::class,
            AddPointsListener::class,
            CommitTransactionListener::class,
        ]
    ];
}
