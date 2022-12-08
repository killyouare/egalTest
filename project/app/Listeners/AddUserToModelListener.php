<?php

namespace App\Listeners;

use App\Abstracts\AbstractEvent;
use App\Abstracts\AbstractListenerWithAttributes;
use App\Helpers\SessionHelper;
use Egal\AuthServiceDependencies\Exceptions\UserNotIdentifiedException;

class AddUserToModelListener extends AbstractListenerWithAttributes
{

    /**
     * @throws UserNotIdentifiedException
     */
    public function handle(AbstractEvent $event): void
    {
        /** @var int|null $user_id */
        $user_id = SessionHelper::getUserId();

        if (!$user_id) {
            throw new UserNotIdentifiedException();
        }

        $event->setModelAttribute('user_id', $user_id);
    }
}
