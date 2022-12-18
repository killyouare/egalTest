<?php

namespace App\Helpers;

use Egal\Model\Model;
use Illuminate\Support\Facades\DB;

class TransactionHelper
{

    static public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    static public function rollback(): void
    {
        DB::rollBack();
    }

    static public function commit(): void
    {
        DB::commit();
    }

    static public function lockTable(Model $model, Lockmode $lockMode, bool $noWait = false): void
    {
        DB::raw(
            vprintf(
                "LOCK TABLE %s in %s mode%s",
                [
                    $model->getTable(),
                    self::lockmodeToString($lockMode),
                    $noWait ? " NOWAIT" : "",
                ]
            )
        );
    }

    static private function lockmodeToString(Lockmode $lm): string
    {
        return match ($lm) {
            Lockmode::AccessShare => "ACCESS SHARE",
            Lockmode::RowShare => "ROW SHARE",
            Lockmode::RowExclusive => "ROW EXCLUSIVE",
            Lockmode::ShareUpdateExclusive => "SHARE UPDATE EXCLUSIVE",
            Lockmode::Share => "SHARE",
            Lockmode::ShareRowExclusive => "SHARE ROW EXCLUSIVE",
            Lockmode::Exclusive => "EXCLUSIVE",
            Lockmode::AccessExclusive => "ACCESS EXCLUSIVE",
        };
    }
}
