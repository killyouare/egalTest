<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListener;
use Illuminate\Support\Facades\DB;

class CommitTransactionListener extends AbstractListener
{

    public function handle(AbstractEvent $event): void
    {
        DB::commit();
    }
}
