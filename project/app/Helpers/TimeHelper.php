<?php

namespace App\Helpers;

use App\Config\TimeFormatConsts;
use Carbon\Carbon;

class TimeHelper
{
    public static function isLaterThenNow(string $time): bool
    {
        return Carbon::now() <= Carbon::createFromFormat(TimeFormatConsts::DATETIME_FORMAT, $time);
    }
}
