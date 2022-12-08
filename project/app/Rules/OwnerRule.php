<?php

namespace App\Rules;

use App\Helpers\SessionHelper;
use Egal\Validation\Rules\Rule as EgalRule;

class OwnerRule extends EgalRule
{

    public function validate($attribute, $value, $parameters = null): bool
    {
        $userId = SessionHelper::getUserId();

        if ($userId === null) {
            return false;
        }

        return $value === $userId;
    }

    public function message(): string
    {
        return "You not owner";
    }

}
