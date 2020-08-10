<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Map;

use G4\ValueObject\Email;
use G4\CustomerSupport\ParamsConst;

class SearchMap
{
    public static function map(Email $email)
    {
        return [
            ParamsConst::QUERY => (string)$email
        ];
    }
}
