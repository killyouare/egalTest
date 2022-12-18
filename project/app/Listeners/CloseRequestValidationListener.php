<?php

namespace App\Listeners;

use App\Abstracts\EventAttributes;
use App\Abstracts\ListenerAttributes;
use App\Models\LotteryGameMatch;
use Egal\Model\Exceptions\ObjectNotFoundException;
use Egal\Model\Exceptions\UpdateException;
use Egal\Model\Exceptions\ValidateException;

class CloseRequestValidationListener extends ListenerAttributes
{

    /**
     * @throws ObjectNotFoundException|UpdateException|ValidateException
     */
    public function handle(EventAttributes $event): void
    {
        $attributes = $event->getEventAttributes();

        $instance = new LotteryGameMatch();

        if (!isset($attributes[$instance->getKeyName()])) {
            throw new UpdateException('The identifier of the entity being updated is not specified!');
        }

        $id = $attributes[$instance->getKeyName()];

        $instance->validateKey($id);

        /** @var ?LotteryGameMatch $item */
        $item = $instance->query()
            ->find($id);

        if (!$item) {
            throw ObjectNotFoundException::make($id);
        }

        $event->setModel($item);
    }

}
