<?php

namespace App\Rules;

use Egal\Core\Session\Session;
use Egal\Validation\Rules\Rule as EgalRule;

class OwnerRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $userId = Session::getUserServiceToken()->getAuthInformation()['id'];

        return $value === $userId;
    }

    public function message(): string
    {
        return "You not owner"; // TODO
    }

}
