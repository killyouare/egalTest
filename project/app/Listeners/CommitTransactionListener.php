<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListener;
use App\Abstracts\Event;
use Illuminate\Support\Facades\DB;

class CommitTransactionListener extends AbstractListener
{

    public function handle(Event $event): void
    {
        DB::commit();
    }
}
