<?php

namespace App\Listeners;

use App\Helpers\AbstractEvent;
use App\Helpers\AbstractListener;
use App\Helpers\SessionHelper;
use Egal\AuthServiceDependencies\Exceptions\UserNotIdentifiedException;

class AddUserToModelListener extends AbstractListener
{

    /**
     * @throws UserNotIdentifiedException
     */
    public function handle(AbstractEvent $event): void
    {
        $user_id = SessionHelper::getUserId();

        if (!$user_id) {
            throw new UserNotIdentifiedException();
        }

        $event->setModelAttribute('user_id', $user_id);
    }
}
