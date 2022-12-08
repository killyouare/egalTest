<?php

namespace App\Helpers;

use Egal\Core\Session\Session;

class SessionHelper
{

    public static function getUserId(): ?int
    {
        return Session::getUserServiceToken()->getAuthInformation()['id'] ?? null;
    }

    public static function getUserRoles(): ?array
    {
        return Session::getUserServiceToken()->getRoles() ?? null;
    }
}
