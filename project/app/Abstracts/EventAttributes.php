<?php

namespace App\Abstracts;

use App\Exceptions\ModelNotFoundException;
use Egal\Model\Model;

abstract class EventAttributes extends Event
{

    protected array $attributes;

    public function __construct(array $value)
    {
        $this->attributes = $value;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getModel(): Model
    {
        if (!$this->isSetModel()) {
            throw new ModelNotFoundException();
        }

        return $this->model;
    }

    public function getEventAttributes(): array
    {
        return $this->attributes;
    }
}
