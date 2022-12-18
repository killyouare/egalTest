<?php

namespace App\Listeners;

use App\Abstracts\Event;
use App\Abstracts\Listener;
use App\Helpers\TransactionHelper;

class BeginTransactionListener extends Listener
{

    public function handle(Event $event): void
    {
        TransactionHelper::beginTransaction();
    }
}
