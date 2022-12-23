<?php

namespace App\Abstracts;

use Egal\Core\Events\Event as EgalEvent;
use Egal\Model\Model;

abstract class Event extends EgalEvent
{

    protected ?Model $model;

    public function getAttributes(): array
    {
        return $this->getModel()->getAttributes();
    }

    public abstract function getModel(): Model;

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getAttribute(string $name): mixed
    {
        return $this->getModel()->getAttribute($name);
    }

    public function setModelAttribute(string $name, mixed $value): void
    {
        $this->getModel()->setAttribute($name, $value);
    }

    public function unsetModelAttribute(string $attr): void
    {
        $this->getModel()->offsetUnset($attr);
    }

    protected function isSetModel(): bool
    {
        return !is_null($this->model);
    }
}
