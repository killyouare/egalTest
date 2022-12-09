<?php

namespace App\Exceptions;

use Egal\Model\Exceptions\NotFoundException;

class ModelNotFoundException extends NotFoundException
{
    protected $message = "Event model is not found";
}
