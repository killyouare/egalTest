<?php

namespace App\Listeners;

use App\Abstracts\Event;
use App\Abstracts\Listener;
use App\Helpers\TransactionHelper;

class CommitTransactionListener extends Listener
{

    public function handle(Event $event): void
    {
        TransactionHelper::commit();
    }
}
