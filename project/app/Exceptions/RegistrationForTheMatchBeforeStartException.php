<?php

namespace App\Exceptions;

use Exception;

class RegistrationForTheMatchBeforeStartException extends Exception
{

    protected $code = 400;
    protected $message = "You cannot register for a match before it starts.";
}
