<?php

namespace App\Exceptions;

use Exception;

class ValidatedException extends Exception
{

    protected $code = 400;
}
