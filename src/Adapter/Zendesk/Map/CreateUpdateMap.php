<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Map;

use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\ParamsConst;

class CreateUpdateMap
{
    public static function map(User $user)
    {
        return [
            ParamsConst::USER => [
                ParamsConst::NAME  => (string)$user->getName(),
                ParamsConst::EMAIL => (string)$user->getEmail()
            ]
        ];
    }
}
