<?php

namespace App\Listeners;

use App\Abstracts\EventModel;
use App\Abstracts\ListenerModel;
use App\Helpers\SessionHelper;
use Egal\AuthServiceDependencies\Exceptions\UserNotIdentifiedException;

class AddUserToModelListener extends ListenerModel
{

    /**
     * @throws UserNotIdentifiedException
     */
    public function handle(EventModel $event): void
    {
        /** @var int|null $user_id */
        $user_id = SessionHelper::getUserId();

        if ($user_id === null) {
            throw new UserNotIdentifiedException();
        }

        $event->setModelAttribute('user_id', $user_id);
    }
}
