<?php

namespace App\Abstracts;

use Egal\Model\Model;

interface Event
{
    public function setModel(Model $model): void;

    public function getModel(): Model;

    public function getAttributes(): array;

    public function getAttribute(string $name): mixed;

    public function setModelAttribute(string $name, mixed $value): void;

}
