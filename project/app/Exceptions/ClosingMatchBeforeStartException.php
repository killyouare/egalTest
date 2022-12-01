<?php

namespace App\Exceptions;

use Exception;

class ClosingMatchBeforeStartException extends Exception
{

    protected $code = 400;

    protected $message = "You can't close a match before it starts";
}
