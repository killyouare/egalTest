<?php

namespace App\Exceptions;

use Egal\Model\Exceptions\NotFoundException as Exception;

class WinnerNotFoundException extends Exception
{

    protected $message = "Winner not found";
}
