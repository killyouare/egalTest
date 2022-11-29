<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\ValidatedLotteryGameMatchUserEvent;
use App\Listeners\ReParticipationListener;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        ValidatedLotteryGameMatchUserEvent::class => [
            ReParticipationListener::class
        ]
    ];

}
