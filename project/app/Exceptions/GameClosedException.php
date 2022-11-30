<?php

namespace App\Exceptions;

use Exception;

class GameClosedException extends Exception
{

    protected $code = 400;

    protected $message = "The game is already closed";
}
