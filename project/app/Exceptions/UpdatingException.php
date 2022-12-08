<?php

namespace App\Exceptions;

use Exception;

class UpdatingException extends Exception
{
    protected $code = 400;
}
