<?php

namespace App\Listeners;

use App\Abstracts\Event;
use App\Abstracts\Listener;
use App\Helpers\Lockmode;
use App\Helpers\TransactionHelper;
use App\Models\LotteryGameMatchUser;

class LockTableLotteryGameMatchUserInExclusiveModeListener extends Listener
{

    public function handle(Event $event): void
    {
        TransactionHelper::lockTable(new LotteryGameMatchUser(), Lockmode::Exclusive);
    }
}
