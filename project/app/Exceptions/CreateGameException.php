<?php

namespace App\Exceptions;

use Exception;

class CreateGameException extends Exception
{

    protected $code = 400;
    protected $message = "You cannot create a game that starts earlier than now";
}
