<?php

namespace App\Helpers;

use Egal\Core\Session\Session;

class SessionHelper
{

    public static function getUserId(): int|null
    {
        return Session::getUserServiceToken()->getAuthInformation()['id'] ?? null;
    }
}
