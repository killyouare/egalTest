<?php

namespace App\Abstracts;

use Egal\Model\Model;

abstract class EventModel extends Event
{

    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
