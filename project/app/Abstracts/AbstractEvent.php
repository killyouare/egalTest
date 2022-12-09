<?php

namespace App\Abstracts;

use Egal\Core\Events\Event as EgalEvent;
use Egal\Model\Model;

abstract class AbstractEvent extends EgalEvent implements Event
{

    private Model $model;

    public function __construct(Model $value)
    {
        $this->model = $value;
    }

    public function getAttributes(): array
    {
        return $this->getModel()->getAttributes();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

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
        return $this->model !== null;
    }
}
