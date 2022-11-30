<?php

namespace App\Helpers;

use Egal\Core\Events\Event;
use Egal\Model\Model;

abstract class AbstractEvent extends Event
{

    private Model $model;

    private array $attributes;

    public function __construct(mixed $value)
    {
        $type = gettype($value);
        if ($type === "array") {
            $this->attributes = $value;
        } else {
            $this->setModel($value);
        }
    }

    public function getEventAttributes(): array
    {
        return $this->attributes;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getAttributes(): array
    {
        return $this->model->getAttributes();
    }

    public function getAttribute(string $name): mixed
    {
        return $this->model->getAttribute($name);
    }

    public function setModelAttribute(string $name, mixed $value): void
    {
        $this->model->setAttribute($name, $value);
    }

    public function unsetModelAttribute(string $attr): void
    {
        $this->model->offsetUnset($attr);
    }
}
