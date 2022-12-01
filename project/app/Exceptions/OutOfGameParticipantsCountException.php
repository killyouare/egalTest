<?php

namespace App\Exceptions;

use Exception;

class OutOfGameParticipantsCountException extends Exception
{

    protected $code = 400;
    protected $message = "All places are filled";
}
