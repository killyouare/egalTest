<?php

namespace App\Exceptions;

use Exception ;

class ReParticipationException extends Exception
{
    protected $code = 400;
    protected $message = "You can't participate twice";
}
