<?php

namespace App\Abstracts;

use App\Exceptions\ModelNotFoundException;
use Egal\Model\Model;

abstract class AbstractEventWithAttributes extends AbstractEvent implements EventWithAttributes
{
    private array $attributes;

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

        return parent::getModel();
    }

    public function getEventAttributes(): array
    {
        return $this->attributes;
    }
}
