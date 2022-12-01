<?php

namespace App\Exceptions;

use Exception;

class NoMembersException extends Exception
{

    protected $code = 400;
    protected $message = "The game has no members";
}
