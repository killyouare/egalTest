<?php

namespace App\Exceptions;

use Egal\Model\Exceptions\NotFoundException;

class ModelNotFoundException extends NotFoundException
{
    protected $message = "Model not found";
}
